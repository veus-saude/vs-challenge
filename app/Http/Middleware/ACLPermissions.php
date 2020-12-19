<?php

    namespace App\Http\Middleware;

    use App\Models\Permission;
    use App\Models\PermissionRole;
    use App\Models\Role;
    use App\Response\Error;
    use Closure;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Route;
    use Gate;

    class ACLPermissions
    {
        /**
         * Handle an incoming request.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  \Closure  $next
         * @return mixed
         */
        public function handle($request, Closure $next)
        {
            try
            {
                $request["cpf"] = str_replace([".","-","/"], "", $request["cpf"]);
                $request["cep"] = str_replace([".","-","/"], "", $request["cep"]);

                $routeTypeWeb = array_search("web", $request->route()->middleware());
                if($routeTypeWeb!==false)
                {
                    if($request->ajax())
                    {
                        $request["routeType"] = "api";
                    }
                    else
                    {
                        $request["routeType"] = "web";
                    }
                }

                $routeTypeAPI = array_search("api", $request->route()->middleware());
                if($routeTypeAPI!==false)
                {
                    $request["routeType"] = "api";
                }

                self::setupRoutes();

                // Is security in Permissions ACL
                $permission = $this->permissions($request);
                if($permission)
                {
                    return $permission;
                }
                self::idNotExist($request);
            }
            catch (\Exception $e)
            {
                return Error::generic(null, messageErrors(5004), $request["routeType"], "panel.main.index");
            }

            return $next($request);
        }

        /**
         * @param Request $request
         * @return bool|void
         */
        public static function idNotExist(Request $request)
        {
            if(isset($request->model)&& empty($request->route()->parameter("id"))==false)
            {
                $model = $request->model::find($request->route()->parameter("id"));
                if($model==null)
                {
                    return Error::generic(null, messageErrors(1004), $request["routeType"]);
                }
            }
        }

        /**
         * @param $request
         * @return bool|\Illuminate\Http\RedirectResponse|Mixed|Void
         */
        public function permissions(Request $request)
        {
            if(isset($request->route()->wheres["roles_ids"]) && Gate::denies($request->route()->getName()))
            {
                if($request->route()->getName()=="login")
                {
                    Auth::logout();
                    session()->flush();
                    return Error::generic(null, messageErrors(5004), $request["routeType"], "login");
                }
                return Error::generic(null, messageErrors(5004), $request["routeType"]);
            }
        }

        public static function setupRoutes()
        {
            $routesAll = self::exceptionRoutes();
            foreach ($routesAll as $routeArray)
            {
                $data = [];
                $data["name"]              = $routeArray->getName();
                $data["label"]             = $routeArray->wheres["label"];
                $data["group"]             = $routeArray->wheres["group"];
                $permissionExist = Permission::where("name", $routeArray->getName())->get()->first();
                if($permissionExist==null)
                {
                    $permission = Permission::create($data);
                }
                else
                {
                    $permissionExist->update($data);
                    $permission = $permissionExist;
                }

                if(isset($routeArray->wheres["roles_ids"]) && $routeArray->wheres["roles_ids"]!="null" && $routeArray->wheres["roles_ids"]!="all")
                {
                    $ids = explode(",", $routeArray->wheres["roles_ids"]);
                    if(count($ids) > 1)
                    {
                        $rolesIds = Role::whereIn("id", $ids)->get();
                        foreach ($rolesIds as $roleId)
                        {
                            $permissionExist = PermissionRole::where("permission_id", $permission->id)->where("role_id", $roleId->id)->get()->first();
                            if($permissionExist==null)
                            {
                                PermissionRole::create([
                                    'permission_id'    => (int) $permission->id,
                                    'role_id'          => (int) $roleId->id,
                                    'system'           => 1,
                                ]);
                            }
                        }
                    }
                    else
                    {
                        $rolesIds = Role::find($routeArray->wheres["roles_ids"]);
                        $permissionExist = PermissionRole::where("permission_id", $permission->id)->where("role_id", $rolesIds->id)->get()->first();
                        if($permissionExist==null)
                        {
                            PermissionRole::create([
                                'permission_id'    => (int) $permission->id,
                                'role_id'          => (int) $rolesIds->id,
                                'system'           => 1,
                            ]);
                        }
                    }
                }
                if(isset($routeArray->wheres["roles_ids"]) && $routeArray->wheres["roles_ids"]!="null" && $routeArray->wheres["roles_ids"]=="all")
                {
                    $rolesIds = Role::all();
                    foreach ($rolesIds as $roleId)
                    {
                        $permissionExist = PermissionRole::where("permission_id", $permission->id)->where("role_id", $roleId->id)->get()->first();
                        if($permissionExist==null)
                        {
                            PermissionRole::create([
                                'permission_id'    => (int) $permission->id,
                                'role_id'          => (int) $roleId->id,
                                'system'           => 1,
                            ]);
                        }
                    }
                }
                if(isset($routeArray->wheres["roles_ids"]) && $routeArray->wheres["roles_ids"]=="null" && $routeArray->wheres["roles_ids"]!="all")
                {
                    $permissionsSystem = PermissionRole::where("system", 1)->where("permission_id", $permission->id)->get();
                    foreach ($permissionsSystem as $ps)
                    {
                        PermissionRole::destroy($ps->id);
                    }
                }
            }
        }

        /**
         * Retorna as rotas que estão dentro do Middleware Permissões
         * @return array
         */
        public static function exceptionRoutes()
        {
            $routesAll = Route::getRoutes()->getRoutes();
            foreach ($routesAll as $key => $route)
            {
                if(!isset($route->wheres["label"]) || !isset($route->wheres["group"]))
                {
                    unset($routesAll[$key]);
                }
            }
            return $routesAll;
        }
    }

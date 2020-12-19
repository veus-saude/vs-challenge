<?php

namespace App\Http\Controllers\Panel;

use App\Helpers\Models\SyncRelations;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Response\Error;
use App\Response\Success;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Gate;

/**
 * Class UserController
 * @package App\Http\Controllers\panel
 */
class UserController extends Controller
{

    /**
     * @var Request
     */
    protected $request;

    /**
     * @var User
     */
    protected $user;

    /**
     * @var Role
     */
    protected $role;


    /**
     * UserController constructor.
     * @param Request $request
     * @param User $user
     * @param Role $role
     */
    public function __construct
    (
        Request $request,
        User $user,
        Role $role
    )
    {
        $this->request = $request;
        $this->user = $user;
        $this->request["model"] = $this->user;
        $this->role = $role;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $list = $this->user::scopeUsersInstitution()->get();
        return view($this->request->route()->getName(), compact( 'list'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $roles = $this->role::where('id', '!=', 1)->get();
        $groups = $this->role::distinct()->get(['group']);
        return view($this->request->route()->getName(), compact('roles', 'groups'));
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        $this->request['password'] = Hash::make($this->request['password']);
        $store = $this->user->create($this->request->all());
        SyncRelations::init($store, "roles", $this->request->roles_ids);
        if($store)
            return Success::generic(
                $store,
                messageSuccess(20000, "Usuários"),
                $this->request["routeType"],
                route("panel.user.index")
            );

        return Error::generic(
            null,
            messageErrors(1000, "Usuários"),
            "web"
        );
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $item = $this->user->find($id);
        $roles = $this->role::where('id', '!=', 1)->get();
        $groups = $this->role::distinct()->get(['group']);
        return view($this->request->route()->getName(), compact('item', 'roles', 'groups'));
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update()
    {
        $item = $this->user->find($this->request['id']);
        $this->user::scopeUpdatePassword($item, $this->request);
        $update = $item->update($this->request->all());
        SyncRelations::init($item, "roles", $this->request->roles_ids);
        if($update)
            return Success::generic(
                $item,
                messageSuccess(20001, "Usuários"),
                $this->request["routeType"],
                route("panel.user.index")
            );

        return Error::generic(
            null,
            messageErrors(1001, "Usuários"),
            "web"
        );
    }


    public function delete($id)
    {
        $delete = $this->user->destroy($id);
        if($delete)
            return Success::generic(
                null,
                messageSuccess(20002, "Usuários"),
                $this->request["routeType"],
                route("panel.user.index")
            );

        return Error::generic(
            null,
            messageErrors(1002, "Usuários"),
            "web"
        );
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function dataTableServerSide(Request $request)
    {
        $columns     = array_column($request["columns"], "name");
        $totalData   = $this->request->model::count();
        $limit       = $request->input('length');
        $start       = $request->input('start');
        $order       = $columns[$request->input('order.0.column')];
        $dir         = $request->input('order.0.dir');

        $posts = $this->request->model::offset($start)
            ->limit($limit)
            ->orderBy($order, $dir)
            ->get();
        $totalFiltered = $this->request->model::count();

        $data        = array();
        if($posts){
            foreach ($posts as $r)
            {
                foreach ($columns as $key => $col)
                {
                    if($col=="full_name")
                    {
                        $nestedData["$col"] = isset($r->first_name) && isset($r->last_name) ? $r->first_name." ".$r->last_name : "-";
                    }
                    elseif($col=="email")
                    {
                        $nestedData["$col"] = $r->$col ?? "-";
                    }
                    elseif($col=="cpf")
                    {
                        $nestedData["$col"] = $r->$col ?? "-";
                    }
                    elseif($col=="roles")
                    {
                        $nestedData["roles"] = $r->roles->pluck("name");
                    }
                    elseif($col=="status")
                    {
                        $nestedData["$col"] = $r->$col ?? "-";
                    }
                    elseif($col=="created_at")
                    {
                        $nestedData["$col"] = date_format($r->created_at, "d/m/Y H:i:s") ?? "-";
                    }
                    elseif($col=="action")
                    {
                        $nestedData["$col"]   = buttons(
                                Gate::allows("panel.user.edit"),
                                "edit",
                                route("panel.user.edit", $r->id),
                                $r
                            )." ";
                        $nestedData["$col"]  .= buttons(
                                Gate::allows("panel.user.delete"),
                                "delete",
                                route("panel.user.delete", $r->id),
                                $r
                            )." ";
                    }
                    else
                    {
                        $nestedData["$col"] = $r->$col;
                    }
                }
                $data[] = $nestedData;
            }
        }
        return response()->json([
            "draw"                          => intval($request->input('draw')),
            "recordsTotal"                  => intval($totalData),
            "recordsFiltered"               => intval($totalFiltered),
            "data"                          => $data,
        ]);
    }

}

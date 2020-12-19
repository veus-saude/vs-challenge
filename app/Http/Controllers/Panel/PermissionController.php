<?php

namespace App\Http\Controllers\Panel;

use App\Helpers\Models\SyncRelations;
use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use App\Response\Error;
use App\Response\Success;
use Illuminate\Http\Request;

/**
 * Class PermissionController
 * @package App\Http\Controllers\panel
 */
class PermissionController extends Controller
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * @var Role
     */
    protected $role;

    /**
     * @var Permission
     */
    protected $permission;

    /**
     * RoleController constructor.
     * @param Request $request
     * @param Role $role
     * @param Permission $permission
     */
    public function __construct
    (
        Request $request,
        Role $role,
        Permission $permission
    )
    {
        $this->request = $request;
        $this->role = $role;
        $this->permission = $permission;
        $this->request["model"] = $this->permission;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $list = $this->permission->where('id', '!=', 1)->get();
        $groups = $this->role::distinct()->get(['group']);
        $roles = $this->role::where('id', '!=', 1)->get();
        return view($this->request->route()->getName(), compact('list', 'groups', 'roles'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $roles = $this->role::where('id', '!=', 1)->get();
        $groups = $this->role::distinct()->get(['group']);
        $group_permission = $this->permission::distinct()->get(['group']);
        return view($this->request->route()->getName(), compact( 'roles', 'groups', $group_permission));
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        $store = $this->permission->create($this->request->all());
        SyncRelations::init($store, "roles", $this->request->roles_ids);
        if($store)
            return Success::generic(
                null,
                messageSuccess(20000, "Permissões"),
                $this->request["routeType"],
                route("panel.permission.index")
            );

        return Error::generic(
            null,
            messageErrors(1000, "Permissões"),
            "web"
        );
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $item = $this->permission->find($id);
        $roles = $this->role::where('id', '!=', 1)->get();
        $groups = $this->role::distinct()->get(['group']);
        $group_permission = $this->permission::distinct()->get(['group']);
        return view($this->request->route()->getName(), compact( 'item', 'roles', 'groups', 'group_permission'));
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update()
    {
        $item = $this->permission->find($this->request['id']);
        $update = $item->update($this->request->all());
        SyncRelations::init($item, "roles", $this->request->roles_ids);
        if($update)
            return Success::generic(
                null,
                messageSuccess(20001, "Permissões"),
                $this->request["routeType"],
                route("panel.permission.index")
            );

        return Error::generic(
            null,
            messageErrors(1001, "Permissões"),
            "web"
        );
    }


    public function delete($id)
    {
        $delete = $this->permission->destroy($id);
        if($delete)
            return Success::generic(
                null,
                messageSuccess(20002, "Permissões"),
                $this->request["routeType"],
                route("panel.permission.index")
            );

        return Error::generic(
            null,
            messageErrors(1003, "Permissões"),
            "web"
        );
    }
}

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
 * Class RoleController
 * @package App\Http\Controllers\panel
 */
class RoleController extends Controller
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
        $this->request["model"] = $this->role;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $list = $this->role->where('id', '!=', 1)->get();
        $groups = $this->permission::distinct()->get(['group']);
        $permissions = $this->permission::all();
        return view($this->request->route()->getName(), compact('list', 'groups', 'permissions'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $groups = $this->permission::distinct()->get(['group']);
        $permissions = $this->permission::all();
        $group_role = $this->role::distinct()->get(['group']);
        return view($this->request->route()->getName(), compact('groups','permissions', 'group_role'));
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        if(auth()->user()->roles->first()->client==1)
        {
            $this->request["client"] = 1;
        }
        $store = $this->role->create($this->request->all());
        SyncRelations::init($store, "permissions", $this->request->permissions_ids);
        if($store)
            return Success::generic(
                null,
                messageSuccess(20000, "Funções"),
                $this->request["routeType"],
                route("panel.role.index")
            );

        return Error::generic(
            null,
            messageErrors(1000, "Funções"),
            "web"
        );
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $item = $this->role->find($id);
        $groups = $this->permission::distinct()->get(['group']);
        $permissions = $this->permission::all();
        $group_role = $this->role::distinct()->get(['group']);
        return view($this->request->route()->getName(), compact('item', 'groups','permissions', 'group_role'));
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update()
    {
        // Erro request vindo dados diretos da tabela e não do form
        $this->request["name"]  = $this->request["data_name"];
        $this->request["label"] = $this->request["data_label"];
        $this->request["group"] = $this->request["data_group"];

        $item = $this->role->find($this->request['id']);
        $update = $item->update($this->request->all());
        SyncRelations::init($item, "permissions", $this->request->permissions_ids);
        if($update)
            return Success::generic(
                null,
                messageSuccess(20001, "Funções"),
                $this->request["routeType"],
                route("panel.role.index")
            );

        return Error::generic(
            null,
            messageErrors(1001, "Funções"),
            "web"
        );
    }


    public function delete($id)
    {
        $delete = $this->role->destroy($id);
        if($delete)
            return Success::generic(
                null,
                messageSuccess(20002, "Funções"),
                $this->request["routeType"],
                route("panel.role.index")
            );

        return Error::generic(
            null,
            messageErrors(1002, "Funções"),
            "web"
        );
    }
}

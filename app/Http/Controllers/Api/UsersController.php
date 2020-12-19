<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Models\SyncRelations;
use App\Http\Controllers\Controller;
use App\Response\Error;
use App\Response\Success;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

/**
 * Class UsersController
 * @package App\Http\Controllers\Api
 */
class UsersController extends Controller
{

    /**
     * @var
     */
    protected $model;

    /**
     * @var Request
     */
    protected $request;

    /**
     * @var User
     */
    protected $user;

    /**
     * @param Request $request
     * @param User $user
     */
    public function __construct
    (
        Request $request,
        User $model
    )
    {
        $this->request = $request;
        $this->model = $model;
        $this->request["model"] = $this->model;
    }

    /**
     * @return bool|\Illuminate\Http\RedirectResponse|void
     */
    public function index()
    {
        $list = $this->model->paginate(20);
        return Success::generic(
            $list, messageSuccess(50000, "Lista de Usuários mostrada com sucesso!"),
            "api"
        );
    }

    /**
     * @return bool|\Illuminate\Http\RedirectResponse|void
     */
    public function store()
    {
        if(isset($this->request["use_api"]) && $this->request["use_api"]==0 ? $this->request["roles_ids"]=[2] : $this->request["roles_ids"]=[2,3]);
        if($this->request["terms"]=="on" ? $terms=1 : $terms=0);
        $institution = User::scopeCreateInstitution($this->request->all());
        $create =  User::create([
            'first_name'         => $this->request['first_name'],
            'last_name'          => $this->request['last_name'],
            'email'              => $this->request['email'],
            'cpf'                => $this->request['cpf'],
            'password'           => Hash::make($this->request['password']),
            'terms'              => $terms,
            'system'             => 0,
            "institution_id"     => $institution->id
        ]);
        SyncRelations::init($create, "roles", $this->request["roles_ids"]);
        if($create)
        {
            return Success::generic(
                $create,
                messageSuccess(20000, "Usuário"),
                "api"
            );
        }
        return Error::generic(
            null,
            messageErrors(1000, "Usuário"),
            "api"
        );
    }

}

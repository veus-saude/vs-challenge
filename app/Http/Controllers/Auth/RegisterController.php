<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\Models\SyncRelations;
use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

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
        $this->middleware('guest');
        $this->request = $request;
        $this->user = $user;
        $this->request["model"]         = $this->user;
        $this->request["roles_ids"]     = [2];
        $this->request["name"]          = "Usuário do Sistema";
        $this->request["label"]         = "Função do Usuário do Sistema";
        $this->request["group"]         = "Funções do Sistema";
        $this->role = $role;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name'        => ['required', 'string', 'max:255'],
            'last_name'         => ['required', 'string', 'max:255'],
            'email'             => ['required', 'string', 'email', 'max:255'],
            'cpf'               => ['required', 'string', 'unique:users'],
            'password'          => ['required', 'string', 'min:4', 'confirmed'],
            'terms'             => ['required']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        if($data["terms"]=="on" ? $terms=1 : $terms=0);
        if(isset($data["use_api"]) && $data["use_api"]==0 ? $roles_ids=[2] : $roles_ids=[2,3]);
        $institution = User::scopeCreateInstitution($data);
        $create =  User::create([
            'first_name'         => $data['first_name'],
            'last_name'          => $data['last_name'],
            'email'              => $data['email'],
            'cpf'                => $data['cpf'],
            'password'           => Hash::make($data['password']),
            'terms'              => $terms,
            'system'             => 0,
            "institution_id"     => $institution->id
        ]);
        SyncRelations::init($create, "roles", $roles_ids);
        return $create;
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        $request["system"] = 1;
        event(new Registered($user = $this->create($request->all())));
        $this->guard()->login($user);
        return $this->registered($request, $user)
            ?: redirect()->route("panel.main.index")
                ->withInput()
                ->with("data", $request->all())
                ->with("success", "Cadastrado com sucesso!");
    }
}

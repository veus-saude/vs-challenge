<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use GuzzleHttp\Client;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'name.required' => "É necessário preencher o campo nome.",
            'name.max' => "O campo nome não pode ser maior que 255 caracteres.",
            'email.required' => "É necessário preencher o campo e-mail.",
            'email.max' => "O campo e-mail não pode ser maior que 255 caracteres.",
            'email.unique' => "E-mail já cadastrado.",
            'password.required' => "É necessário preencher o campo password.",
            'password.min' => "O campo password tem que ter no mínimo 8 caracteres.",
            'password.confirmed' => "A password digitada não corresponde.",
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
        $client = new Client();
        $response = $client->post('http://localhost/api/v1/register', [
            'form_params' => [
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => $data['password'],
                'c_password' => $data['password'],
            ]
        ]);
        // dd(json_decode((string) $response->getBody(), true)['data']['token']);

        session()->put('token', json_decode((string) $response->getBody(), true)['data']['token']);
        
        $user = User::where('email',$data['email'])->first();        

        return $user;
    }
}

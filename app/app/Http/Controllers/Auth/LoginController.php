<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use GuzzleHttp\Client;
use DB;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/produtos';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ],  [
            'email.required' => "É necessário preencher o campo e-mail.",             
            'password.required' => "É necessário preencher o campo password.",            
        ]);
    }


    protected function authenticated(Request $request, $user)
    {
        $client = new Client();

        $client_secret = DB::table('oauth_clients')->where('id', 2)->first();

        $response = $client->post('http://localhost/oauth/token', [
            'form_params' => [
                'username' => $request['email'],
                'password' => $request['password'],
                'grant_type' => 'password',
                'client_id' => '2',
                'client_secret' =>  $client_secret->secret
            ]
        ]);

        session()->put('token', json_decode((string) $response->getBody(), true)['access_token']);
    }


    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            'email' => ['Essas credenciais não correspondem aos nossos registros.'],
        ]);
    }
}

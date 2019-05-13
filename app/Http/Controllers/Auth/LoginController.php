<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    public function login()
    {

        try {
            $client = new \GuzzleHttp\Client();
            $body['email'] = "hygino.thiago@gmail.com";
            $body['password'] = "123456";
            $url = "http://10.11.0.222/api/login";
            $response = $client->request('POST', $url, [
                    'form_params' => $body
                ]
            );

            \session('token', json_decode($response->getBody(), true)['token']);
            return redirect()->action('ProductController@index');

        }catch (ClientException $e){
            var_dump($e->getCode());

        }catch (\Exception $e){
            var_dump($e->getMessage());
        }


    }
}

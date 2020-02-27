<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use View;

class RegisterController extends Controller
{
    public function index(){
        return View::make('index');
    }
    
    public function register(Request $request){
        $user = new User();
        $user->email = $request->email;
        $user->password = $request->password;
        $user->	remember_token = $request->_token;
        $user->save();
    }
}
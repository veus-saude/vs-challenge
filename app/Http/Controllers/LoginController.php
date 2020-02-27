<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use View;

class LoginController extends Controller
{
    public function index(){
        return View::make('login');
    }
    
    public static function logon(Request $request){
        $users = User::select('id')
        ->where('email','=',$request->email)
        ->where('password','=',$request->password)->get();
        
        if(count($users) > 0){
            try{
                foreach($users as $user){
                    $findUser = User::find($user->id);
                    Auth::login($findUser);
                    return redirect()->route('show');
                }
            }
            catch(\Exception $e){
                return $e->getMessage();
            }
        }
        else{
            return redirect()->route('login');
        }
    }
}
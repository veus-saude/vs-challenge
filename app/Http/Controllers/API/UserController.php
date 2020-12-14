<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function login(LoginRequest $request)
    {
        $credenciais = $request->all();

        if (!Auth::attempt($credenciais)) {
            return response()->json(['erro' => 'Acesso Negado'], 401);
        }
        $user = Auth::user();
        $token = $user->createToken('token_veus')->accessToken;
        return response()->json(['token'=> $token], 200);
    }

    public function register(RegisterRequest $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);

        $user->save();
        return response()->json($user, 201);
    }

    public function detalhesLogin()
    {
        $user = Auth::user();
        return response()->json(['success' => $user], '200');
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json(['msg'=> 'Deslogado']);
    }
}

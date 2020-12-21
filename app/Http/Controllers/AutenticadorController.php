<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class AutenticadorController extends Controller
{
    public function registro(Request $request)
    {
        $request->validate([
            "name" => 'required|string',
            "email" => 'required|string|email|unique:users',
            "password" => 'required|between:8,255|confirmed'
        ]);

        $user = new User([
            "name" => $request->name,
            "email" => $request->email,
            "password" => bcrypt($request->password)
        ]);
        $user->save();
        return response()->json([
            'return' => 'Usuario criado com sucesso'
        ], 201);
    }
    public function login(Request $request)
    {
        $request->validate([
            "email" => 'required|string|email',
            "password" => 'required|string'
        ]);

        $credenciais = [
            "email" => $request->email,
            "password" => $request->password
        ];
        if (!Auth::attempt($credenciais)) {
            return response()->json([
                'return' => 'Acesso negado'
            ], 401);
        }
        $user = User::find(Auth::id());
        $token = $user->createToken('token de acesso')->accessToken;
        return response()->json([
            'return' => $token 
        ], 200);
    }

    
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'return' => 'Deslogado com sucesso'
        ], 401);
    }
}

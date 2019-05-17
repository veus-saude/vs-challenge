<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class AutenticadorController extends Controller {
    
    public function registro(Request $request) {
        //nome, email e senha
        $request->validate([
            "name"      => "required|string",
            "email"     => "required|string|email|unique:users",
            "password"  => "required|string|confirmed"
        ]);
        
        $user = new User([
            "name"      => $request->name,
            "email"     => $request->email,
            "password"  => bcrypt($request->password)
        ]);
        
        $user->save();
        
        return response()->json([
            "res" => "Usuário criado com sucesso"
        ], 201);
        
    }
    
    public function login(Request $request) {
        
        $request->validate([
            "email"     => "required|string|email",
            "password"  => "required|string"
        ]);
        
        $credenciais = [
            "email"     => $request->email,
            "password"  => $request->password
        ];
        
        if(!Auth::attempt($credenciais)) {
            return response()->json([
                "res"   => "Acesso negado"
            ], 401);
        }
        
        $user = $request->user();
        $token = $user->createToken("Token de Acesso")->accessToken;
        
        return response()->json([
            "token"   => $token
        ], 200);
        
    }
    
    public function logout(Request $request) {
        $request->user()->token()->revoke();
        
        return response()->json([
           "res"    => "Deslogado com sucesso"
        ]);
    }
}

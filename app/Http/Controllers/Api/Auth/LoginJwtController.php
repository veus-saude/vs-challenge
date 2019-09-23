<?php

namespace App\Http\Controllers\Api\Auth;

use App\Api\ApiMessages;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class LoginJwtController extends Controller
{
    // Faz login retornando token
    public function login(Request $request)
    {

        $credenciais = $request->all(['email', 'password']);

        Validator::make($credenciais, [
            'email'    => 'required|string',
            'password' => 'required|string',
        ])->validate();



        if(! $token = auth('api')->attempt($credenciais)){
            $message = new ApiMessages('Nao autorizado');
            return response()->json($message->getMessage(), 401);
        }

        return response()->json([
            'token' => $token
        ]);
    }

    // Desloga
    public function logout()
    {
        auth('api')->logout();
        return response()->json(['msg' => 'Deslogado com sucesso!'], 200);
    }

    // Atualiza o token
    public function refresh()
    {
        $token = auth('api')->refresh();
        return response()->json([
            'token' => $token
        ]);
    }
}

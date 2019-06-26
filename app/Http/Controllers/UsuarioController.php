<?php

namespace App\Http\Controllers;

use App\Models\Usuarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use JWTAuth;

class UsuarioController extends Controller
{
    public function index(Request $request){
        try {

            $usuario = new Usuarios($request->all());
            if($usuario->save())
                return response()->json(['message' => 'Usuário cadastrado com sucesso!']);
            else
                return response()->json(['message' => 'Usuário não cadastrado!']);

        }catch (\Exception $e){
            Log::error("ERRO::USUARIO", [ 'erro' => $e->getMessage()]);
            return response()->json(['message' => 'Usuário não cadastrado'], 500);
        }
    }

    public function token(Request $request){
        $credentials = $request->only('email', 'password');
        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
        return response()->json(compact('token'));
    }
}

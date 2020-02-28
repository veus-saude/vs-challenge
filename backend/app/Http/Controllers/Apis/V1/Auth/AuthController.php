<?php

namespace App\Http\Controllers\Apis\V1\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    private $guard;

    public function __construct()
    {
        $this->guard = 'api';
    }

    /**
     * Retorna um token JWT apartir das credenciais
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required'
        ]);

        if($validation->fails())
            return response()->json(['errors' => $validation->errors()], 400);

        if(!$token = auth($this->guard)->attempt(request(['username', 'password'])))
            return response()->json(['error' => 'usuário ou senhas incorretos.'], 401);

        return $this->respondWithToken($token);
    }


    /**
     * Método para desautenticar o usuário e invalidar o token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth($this->guard)->logout();
        return response()->json(['message' => 'usuário desaltenticado com sucesso']);
    }

    /**
     * Atualiza o Token do usuário autenticado
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth($this->guard)->refresh());
    }

    /**
     * Cria um novo Registro de Usuário
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'name' => 'required|string|min:3',
            'username' => 'required|string|unique:users|min:4',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6'
        ]);

        if($validation->fails())
            return response()->json(['error' => $validation->errors()], 400);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json($user);
    }

    /**
     * Retorna todos os dados do usuário
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function user()
    {
        return response()->json(auth()->user());
    }

    /**
     * Pega o Token e arruma em uma estrutura de Array
     *
     * @param $token
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => auth($this->guard)->factory()->getTTL() * 60
        ]);
    }
}

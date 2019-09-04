<?php
/**
 * Desenvolvido por: Lucas Maia - lucas.codemax@gmail.com
 * WhatsApp: (21) 96438-6937
 */
namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * @var Request
     */
    private $request;
    /**
     * @var UserService
     */
    private $userService;

    /**
     * Create a new controller instance.
     *
     * @param Request $request
     * @param UserService $userService
     */
    public function __construct(Request $request, UserService $userService)
    {
        $this->userService = $userService;
        $this->request = $request;
    }

    /**
     * Método responsável por fazer a autenticação do Usuário e gerar o Bearer Token
     */
    public function authenticate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'     => 'required|email',
            'password'  => 'required'
        ]);

        if($validator->fails()) {
            return $validator->errors();
        }

        // Busca o usuário pelo e-mail
        $user  = $this->userService->findEmail($request->email);
        if (!$user) {
            return response()->json([
                'error' => 'Usuário não existe com este e-mail.'
            ], Response::HTTP_UNAUTHORIZED);
        }

        $token = $this->userService->attemptLogin($user, $request->password);
        if(!$token) {
            return response()->json([
                'error' => 'E-mail ou senha incorreta.'
            ], Response::HTTP_UNAUTHORIZED);
        }

        return response()->json([
            'token' => $token,
            'user'  => $user
        ], Response::HTTP_OK);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required | email | unique:users,email',
            'name' => 'required',
            'password' => 'required | min:6',
        ]);

        if($validator->fails()) {
            return \response()->json($validator->errors());
        }

        // Previnir campos adicionais no input
        $user = $this->userService->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password
        ]);

        if($user) {
            return \response()->json([
                'status'    => 'success',
                'message'   => 'Usuário "'.$user->name.'" criado com sucesso.',
                'user'      => $user
            ], Response::HTTP_OK);
        }else{
            return \response()->json([
                'status'    => 'error',
                'message'   => 'Não foi possível criar o usuário.',
                'debug'     => $user
            ]);
        }
    }
}

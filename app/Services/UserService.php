<?php
/**
 * Desenvolvido por: Lucas Maia - lucas.codemax@gmail.com
 * WhatsApp: (21) 96438-6937
 *
 * Criado em: 28/08/19 02:08
 * Projeto: Desafio Veus
 */

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use Carbon\Carbon;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserService
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * UserService constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Criar um novo Bearer Token.
     *
     * @param  \App\Models\User  $user
     * @return string
     */
    protected function jwt(User $user)
    {
        $payload = [
            'iss' => "lumen-jwt",  // Identificador do token
            'sub' => $user->id,    // Responsável pelo token
            'iat' => time(),       // Hora que o token foi gerado
            'exp' => time() + 7200 // Expira em 2 horas
        ];

        // Poderia usar JWT_SECRET no especificado no .env
        return JWT::encode($payload, 'JhbGciOiJIU'); // Dessa forma evita erros de configuração no ENV
    }

    public function findEmail($email)
    {
        $user = User::query()->where(['email' => $email])->get();

        if($user->isNotEmpty()) {
            return $user->first();
        }
        return FALSE;
    }

    /**
     * Método responsável por fazer a autenticação do Usuário e gerar o Bearer Token
     */
    public function attemptLogin(User $user, $password)
    {
        if(Hash::check($password, $user->password)) {
            $user->last_login = Carbon::now()->toDateTimeString();
            $user->save();

            return $this->jwt($user);
        }else{
            return FALSE;
        }
    }

    /**
     * @param Request $request
     */
    public function create($params = array())
    {
        try{
            DB::beginTransaction();

            $params['password'] = Hash::make($params['password']);
            $user = User::create($params);

            DB::commit();

            return $user;
        }catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }
    }
}
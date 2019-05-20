<?php

namespace App\Services;


use App\Exceptions\ValidatorException;
use App\Validators\AuthValidator;
use Illuminate\Auth\Access\AuthorizationException;
use Tymon\JWTAuth\JWTAuth;

class AuthService
{
    /**
     * @var AuthValidator
     */
    private $validator;

    /**
     * AuthService constructor.
     */
    public function __construct(AuthValidator $validator)
    {
        $this->validator = $validator;
    }

    public function login(array $data)
    {
        if (!$this->validator->validate($data)) {
            throw new ValidatorException($this->validator->getErrors());
        }

        try {
            $credentials = ['email' => $data['email'], 'password' => $data['password']];

            if (! $token = \Auth::attempt($credentials)) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }

        }  catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            return ['token_expired'];

        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return ['token_invalid'];

        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {

            return ['token_absent' => $e->getMessage()];

        }

        return $token ? ['token' => $token] : ['error' => 'Falha na autenticação!'];
    }

    public function logout()
    {
        return \Auth::guard('api')->logout();
    }

    public function me()
    {
        return \Auth::guard('api')->user();
    }

    public function refresh()
    {
        $token = \Auth::guard('api')->refresh();
        return ['token' => $token];
    }

}
<?php

namespace App\Common;

use App\Exceptions\InvalidUserException;
use App\Exceptions\ExpiredUserException;
use App\Helpers\ValidateAuthentication;
use App\Config\Configuration as cfg;
use Illuminate\Http\Request;
use Firebase\JWT\JWT;

/**
 * This class configure the JWT used in system
 *
 * @since 1.0
 */
class Authenticator
{
    /**
     * Generate the JSON Web Token
     *
     * @since 1.0
     * @param array $options
     * @return string
     */
    public static function generateToken(array $options): string
    {
        $issuedAt = time();
        $expire = $issuedAt + $options['expiration_sec']; // tempo de expiracao do token

        $tokenParam = [
            'iat' => $issuedAt, // timestamp de geracao do token
            'iss' => $options['host'], // dominio, pode ser usado para descartar tokens de outros dominios
            'exp' => $expire, // timestamp de quando o token ir   expirar
            'nbf' => $issuedAt - 1, // token nao eh valido Antes de
            'data' => $options['userdata'], // Dados do usuario logado
        ];

        return JWT::encode($tokenParam, cfg::SALT_KEY);
    }

    /**
     * Decode the JWT used by user
     *
     * @since 1.0
     * @param string $token
     * @return \stdClass
     */
    public static function decodeToken(string $token): \stdClass
    {
        return JWT::decode($token, cfg::SALT_KEY, ['HS256']);
    }

    /**
     * Check the validate of authenticate User
     * @param Request $request
     * @return boolean
     * @throws InvalidUserException
     * @throws ExpiredUserException
     * @throws HeaderWithoutAuthorizationException
     */
    public static function isValidLogin(Request $request): bool
    {
        $token = ValidateAuthentication::token($request);
        $currentHost = $request->getHttpHost();
        if (isset($token->iss) && $token->iss !== $currentHost) {
            throw new InvalidUserException("Host with access denied");
        }
        if (isset($token->exp) && $token->exp < time()) {
            throw new ExpiredUserException("User with expired authentication");
        }
        return true;
    }
}

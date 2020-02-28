<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use JWTAuth;

class ApiProtectdRoute extends BaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            if($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                return response()->json(['message' => 'Token inválido'],401);
            } else if ($e instanceof  \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                return response()->json(['message' => 'Seu Token está expirado'], 401);
            } else if ($e instanceof  \Tymon\JWTAuth\Exceptions\TokenBlacklistedException) {
                return response()->json(['message' => 'Seu token foi para a Blacklist'], 401);
            } else {
                return response()->json(['message' => 'Token não encontrado para autenticação'], 401);
            }
        }

        return $next($request);
    }
}

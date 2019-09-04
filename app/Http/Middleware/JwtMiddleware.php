<?php

namespace App\Http\Middleware;

use App\Models\User;
use Carbon\Carbon;
use Closure;
use Exception;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\JWT;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;

class JwtMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $token = $request->bearerToken();

        if(!$token) {
            // Unauthorized response if token not there
            return response()->json([
                'error' => 'Token não informado.'
            ], Response::HTTP_UNAUTHORIZED);
        }

        try {
            $credentials = JWT::decode($token, 'JhbGciOiJIU', ['HS256']);

            if($credentials->iss == "lumen-jwt")
            {
                return $next($request);
            }else{
                return response()->json([
                    'error' => 'Acesso restrito apenas para Administradores'
                ], Response::HTTP_FORBIDDEN);
            }

        } catch(ExpiredException $e) {
            return response()->json([
                'error' => 'O token expirou.'
            ], Response::HTTP_UNAUTHORIZED);
        } catch(Exception $e) {
            return response()->json([
                'error' => 'Não foi possível decodificar o token.',
                'exception' => $e->getMessage()
            ], Response::HTTP_UNAUTHORIZED);
        }
    }
}

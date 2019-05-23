<?php
namespace App\Http\Middleware;
use Closure;
use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\ExpiredException;
use Laravel\Lumen\Http\Request;

class JwtMiddleware
{
    /**
     * @param Request $request
     * @param Closure $next
     * @param null $guard
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function handle(Request $request, Closure $next, $guard = null)
    {
        $token = $request->bearerToken();

        if (!$token) {
            // Unauthorized response if token not there
            return response()->json([
                'error' => [
                    "code" => 401,
                    "message" => 'Token de acesso não infomado.'
                ]
            ], 401);
        }
        try {
            $credentials = JWT::decode($token, config('jwt.secret'), ['HS256']);
        } catch (ExpiredException $e) {
            return response()->json([
                'error' => [
                    "code" => 400,
                    "message" => 'Token de acesso expirado.'
                ]
            ], 400);
        } catch (Exception $e) {
            return response()->json([
                'error' => [
                    "code" => 400,
                    "message" => 'Token de acesso inválido.'
                ]
            ], 400);
        }

        $user = \App\Source\User::where('token',$token)->first();

        if (!$user) {
            return response()->json([
                'error' => [
                    "code" => 403,
                    "message" => 'Acesso negado.'
                ]
            ], 403);
        }

        $request->auth = $user;

        return $next($request);
    }
}
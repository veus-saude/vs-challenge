<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;
use JWTAuth;

class apiProtectRoute extends BaseMiddleware
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

            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }

        } catch (TokenExpiredException $e) {

            return response()->json(['success' => false ,'message'=>'token_expired'], 404);

        } catch (TokenInvalidException $e) {

            return response()->json(['success' => false, 'message'=>'token_invalid'], 404);

        } catch (JWTException $e) {

            return response()->json(['success' => false, 'message'=>'token_absent'], 404);

        } catch (TokenBlacklistedException $e) {

        return response()->json(['success' => false,  'message'=>'token_invalid'], 404);

    }

        return $next($request);

    }
}
//eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3Q6ODA4MVwvYXBpXC9hdXRoXC9sb2dpbiIsImlhdCI6MTU4MjI2MjgwNSwiZXhwIjoxNTgyMjY2NDA1LCJuYmYiOjE1ODIyNjI4MDUsImp0aSI6Im1LQjdkeThqUEhvMHFmbVUiLCJzdWIiOjEsInBydiI6Ijg3ZTBhZjFlZjlmZDE1ODEyZmRlYzk3MTUzYTE0ZTBiMDQ3NTQ2YWEifQ.4EhrnMJ0KLsOuWwfQpAeAdl4hC-dBiQ0RPde9t2o7cU

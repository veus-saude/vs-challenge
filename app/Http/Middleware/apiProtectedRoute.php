<?php

namespace App\Http\Middleware;

use App\Response\Error;
use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Gate;

class apiProtectedRoute extends BaseMiddleware
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
        try
        {
            $user = JWTAuth::parseToken()->authenticate();
        }
        catch(\Exception $exception)
        {
            if($exception instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException)
            {
                return Error::generic(null, messageErrors(5000), "api");
            }
            elseif($exception instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException)
            {
                return Error::generic(null, messageErrors(5001), "api");
            }
            elseif($exception instanceof \Tymon\JWTAuth\Exceptions\TokenBlacklistedException)
            {
                return Error::generic(null, messageErrors(5002), "api");
            }
            else
            {
                return Error::generic(null, messageErrors(5003), "api");
            }
        }
        return $next($request);
    }
}

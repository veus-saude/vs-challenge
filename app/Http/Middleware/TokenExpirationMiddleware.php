<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;

class TokenExpirationMiddleware
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
        $tokenExpiration = $request->user()->api_token_expiration;
        if((new Carbon($tokenExpiration))->lessThan(new Carbon())){
            return response()->json(['message' => 'Token expired'], 401);
        }
        return $next($request);
    }
}

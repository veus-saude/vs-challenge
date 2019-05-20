<?php

namespace App\Http\Middleware;

use Closure;

class CorsMiddleware
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
        if ($request->is('api/*')) {
            heaader('Access-Control-Allow-Origin: http:localhost:4200');
            heaader('Access-Control-Allow-Headers: Content-Type, Authorization');
        }

        return $next($request);
    }
}

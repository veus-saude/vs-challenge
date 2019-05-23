<?php

namespace App\Http\Middleware;

use Closure;

class Version
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
        app(\App\Version::class, ['version' => $request->segment(env('URL_VERSION_SEGMENT_INDEX', 2))]);
        return $next($request);
    }
}

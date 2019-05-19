<?php

namespace App\Http\Middleware;

use Closure;
use App\User;

class AuthenticateApiV1
{
    public function handle($request, Closure $next)
    {
        $user = User::find($request->headers->get('client-id'));

        if (!$user || $user->client_secret != $request->headers->get('client-secret')) {
            return response()->json(['sucess' => false, 'message' => 'Forbidden'], 403);
        }

        return $next($request);
    }
}

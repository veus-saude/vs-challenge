<?php

namespace App\Http\Middleware;

use App\Common\Authenticator;
use Illuminate\Http\Request;
use Closure;

class AuthenticationApiMiddleware
{

    /**
     * Verify the authenticate os user
     *
     * @author Paulo Henrique <@ph-gaia>
     * @param Request $request
     * @param Response $response
     * @param callable $next
     * @return Response
     */
    public function handle($request, Closure $next)
    {
        try {
            if (Authenticator::isValidLogin($request)) {
                return $next($request);
            }
        } catch (\Exception $ex) {
            return response()->json([
                "message" => $ex->getMessage(),
                "status" => "error"
            ], 401);
        }
    }
}

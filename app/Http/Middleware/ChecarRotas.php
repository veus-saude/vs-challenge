<?php

namespace App\Http\Middleware;

use Closure;

class ChecarRotas
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
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET');
        header('Access-Control-Allow-Headers: Origin, Content-Type, Token, Accept, Authorization, X-Request-With');
        header('Access-Control-Allow-Credentials: true');

        
        $token = $request->header('Authorization');
        $authorization = 1234; //dado mocado podendo vir do banco de dados

        if($request->getPathInfo()== "/") {
            return $next($request);
        }

        if($token == null || $token != $authorization)
            return response('Sem premissao de acesso.', 401);

        else
        {
           return $next($request);
        }
    }
}

<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\Debug\Exception\FatalErrorException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        if($e instanceof NotFoundHttpException ){
            return response()->json([
                'error' => [
                    'code' => 404,
                    'message' => 'Não encontrado.'
                ]
            ],404);
        }else if($e instanceof MethodNotAllowedHttpException){
            return response()->json([
                'error' => [
                    'code' => 405,
                    'message' => 'Método não autorizado.'
                ]
            ],405);
        }else if( $e instanceof FatalErrorException || $e->getCode() === 500 || $e->getCode() === 0 ){
            if( in_array($request->method(), ['POST', 'PUT', 'PATCH']) ){
                return response()->json([
                    'error' => [
                        'code' => 503,
                        'message' => 'Erro interno do servidor.',
                        'exception' => $e->getMessage()." - ".$e->getFile()." - ".$e->getLine()
                    ]
                ],503);
            }
        }

        return parent::render($request, $e);
    }
}

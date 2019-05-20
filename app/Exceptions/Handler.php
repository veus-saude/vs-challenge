<?php

namespace App\Exceptions;

use App\Enums\HttpStatus;
use Exception;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

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
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if ($exception instanceof NotFoundHttpException) {
            return response()->json(['error' => 'resource_not_found'], HttpStatus::NOT_FOUND);
        }

        if ($exception instanceof ModelNotFoundException) {
            return response()->json(['error' => $exception->getMessage()], HttpStatus::NOT_FOUND);
        }

        if ($exception instanceof AuthorizationException) {
            return response()->json(['error' => $exception->getMessage()], HttpStatus::UNAUTHORIZED);
        }

        if ($exception instanceof UnauthorizedHttpException) {
            return response()->json(['error' => 'Unauthorized'], HttpStatus::UNAUTHORIZED);
        }

        if ($exception instanceof MethodNotAllowedHttpException) {
            return response()->json(['error' => 'method_not_allowed'], HttpStatus::METHOD_NOT_ALLOWED);
        }


        if ($exception instanceof ValidatorException) {
            return response()->json($exception->errors, HttpStatus::UNPROCESSABLE_ENTITY);
        }

        return parent::render($request, $exception);
    }
}

<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param Exception $exception
     * @return mixed|void
     * @throws Exception
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
        if ($request->isJson()) {
//        if (substr($request->route()->getPrefix(), 0, 3) === 'api') {
            return $this->handleApiException($request, $exception);
        } else {
            $retval = parent::render($request, $exception);
        }

        return $retval;
    }

    /**
     * @param $request
     * @param Exception $exception
     * @return mixed
     */
    private function handleApiException($request, Exception $exception)
    {
        $exception = $this->prepareException($exception);

        if ($exception instanceof HttpResponseException) {
            $exception = $exception->getResponse();
        }

        if ($exception instanceof AuthenticationException) {
//            $exception = $this->unauthenticated($request, $exception);
            $exception = response()->json(['message' => $exception->getMessage()], 401);
        }

        if ($exception instanceof ValidationException) {
//            $exception = $this->convertValidationExceptionToResponse($exception, $request);
            $exception = $this->invalidJson($request, $exception);
        }

        return $this->customApiResponse($exception);
    }

    /**
     * @param $exception
     * @return \Illuminate\Http\JsonResponse
     */
    private function customApiResponse($exception)
    {
        if (method_exists($exception, 'getStatusCode')) {
            $statusCode = $exception->getStatusCode();
        } else {
            $statusCode = 500;
        }

        $response = [];

        switch ($statusCode) {
            case 401:
                $response['message'] = 'Não Autorizado';
                break;
            case 403:
                $response['message'] = 'Requisição Proibida';
                break;
            case 404:
                $response['message'] = 'Rota Não encotrada';
                break;
            case 405:
                $response['message'] = 'Método Não Permitido';
                break;
            case 422:
                $response['message'] = $exception->original['message'];
                $response['errors'] = $exception->original['errors'];
                break;
            default:
                $response['message'] = ($statusCode === 500) ? 'Opa, Parece que algo deu errado:' : $exception->getMessage();
                break;
        }

        $response['status'] = $statusCode;

        return response()->json($response, $statusCode);
    }
}

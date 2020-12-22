<?php

namespace App\Exceptions\Traits;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;

trait ApiException
{

    /**
     * Trata as exceções da API.
     *
     * @param Request $request
     * @param Exception $exception
     */
    public function getJsonException($request, $exception)
    {
        if ($exception instanceof UnauthorizedHttpException) {
            return $this->unauthorizedException();
        }

        if ($exception instanceof ModelNotFoundException) {
            return $this->notFoundException();
        }
         if($exception instanceof ValidationException){
            return $this->validationException($exception);
        }

        return $this->genericException();
    }


    /**
     * Retorna erros de validação.
     *
     */
    protected function validationException($exception)
    {
        return response()->json([
            "error" => $exception->errors(),
            "errCode" => $exception->status
        ], $exception->status);
    }

    /**
     * Retorna o erro 404.
     *
     */
    protected function notFoundException()
    {
        return $this->getResponse(404, "Recurso não encontrado.", Response::HTTP_NOT_FOUND);
    }

    /**
     * Retorna o erro 401.
     *
     */
    protected function unauthorizedException(){
        return $this->getResponse(401, "Você não está logado.", Response::HTTP_UNAUTHORIZED);
    }

    /**
     * Retorna um erro genérico em JSON, com código, a mensagem de erro e o status.
     *
     */
    protected function genericException()
    {
        return response()->json([
            'errCode' => 500,
            'error' =>  "Erro interno do servidor"
        ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * Retorna o erro em JSON, com código, a mensagem de erro e o status.
     *
     * @param int $errCode
     * @param string $error
     * @param int $status
     */
    protected function getResponse($errCode, $error, $status)
    {
        return response()->json([
            'errCode' => $errCode,
            'error' =>  $error
        ], $status);
    }
}

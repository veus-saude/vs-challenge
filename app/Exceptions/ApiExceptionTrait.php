<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

trait ApiExeceptionTrait {

    public function apiExeception($request, $exception)
    {
        if ($exception instanceof NotFoundHttpException) {
            return response()->json([
                'errors' => 'Incorrect route'
            ], HttpFoundationResponse::HTTP_NOT_FOUND);
        }

        if ($exception instanceof ModelNotFoundException) {
            $model = explode('\\', $exception->getModel());
            return response()->json([
                'errors' => $model[1].' not found'
            ], HttpFoundationResponse::HTTP_NOT_FOUND);
        }

        if ($exception instanceof QueryException) {
            $code = $exception->getCode();
            return response()->json([
                'errors' => 'SQL error. Check the fields'
            ], HttpFoundationResponse::HTTP_BAD_REQUEST);
        }
    }
}
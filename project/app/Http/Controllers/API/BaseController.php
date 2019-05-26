<?php


namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

/**
 * Class BaseController.
 *
 * @package App\Http\Controllers\API
 */
class BaseController extends Controller
{
    /**
     * Return response.
     *
     * @param $result
     * @param string $message
     * @param int $code
     * @return JsonResponse
     */
    public function sendResponse(array $result, string $message, int $code = Response::HTTP_OK) : JsonResponse
    {
        $response = [
            'success' => true,
            'data' => $result,
            'message' => $message
        ];

        return response()->json($response, $code);
    }

    /**
     * Return error response.
     *
     * @param string $error
     * @param mixed $errorMessage
     * @param int $code
     * @return JsonResponse
     */
    public function sendError(string $error, $errorMessage = [], int $code = Response::HTTP_NOT_FOUND) : JsonResponse
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];

        if (!empty($errorMessage)) {
            $response['data'] = $errorMessage;
        }

        return response()->json($response, $code);
    }
}

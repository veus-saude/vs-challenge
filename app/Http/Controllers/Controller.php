<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    public function customResponse($message = 'success', $status = 200) {
        return response(['status' => $status, 'message' => $message], $status);
    }
}

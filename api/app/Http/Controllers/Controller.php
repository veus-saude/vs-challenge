<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    // CONST OK_STATUS             = 200;
    // CONST CREATED_STATUS        = 201;
    // CONST UNAUTHORIZED_STATUS   = 401;
    // CONST NO_CONTENT_STATUS     = 204;
}

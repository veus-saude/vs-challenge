<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;

/**
 * Class HitsPagesController
 * @package App\Http\Controllers\system
 */
class HitsPagesController extends Controller
{
    /**
     * @return bool|\Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        return true;
    }
}

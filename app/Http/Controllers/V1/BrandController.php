<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Services\BrandService;

class BrandController extends Controller
{
    /**
     * @var BrandService
     */
    private $service;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(BrandService $service)
    {
        $this->service = $service;
    }

    public function getAll()
    {
        return $this->service->all();
    }
}

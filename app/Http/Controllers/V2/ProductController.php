<?php

namespace App\Http\Controllers\V2;

use App\Enums\HttpStatus;
use App\Http\Controllers\V1\ProductController as Controller;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * @var ProductService
     */
    private $service;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ProductService $service)
    {
        $this->service = $service;
    }

    public function query(Request $request)
    {
        return $this->service->query($request->all());
    }

    public function post(Request $request)
    {
        return response()->json($this->service->save($request->all()),HttpStatus::CREATED);
    }

    public function put(Request $request, $id)
    {
        return response()->json($this->service->save($request->all(), $id));
    }
}

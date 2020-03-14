<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use Model\Product\ProductRepositoryInterface;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{

    private $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index()
    {
        return $this->successResponse($this->productRepository->all());
    }

    public function create()
    {
        //
    }

    public function show($product_id)
    {
        return $this->successResponse($this->productRepository->get($product_id));
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}

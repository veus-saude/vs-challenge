<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Requests\V2\EditProductRequest;
use App\Http\Requests\V2\CreateProductRequest;
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

    public function store(CreateProductRequest $request)
    {
        return $this->successResponse($this->productRepository->create($request->all()));
    }

    public function show($product_id)
    {
        return $this->successResponse($this->productRepository->get($product_id));
    }

    public function update(EditProductRequest $request, $product_id)
    {
        return $this->successResponse($this->productRepository->update($product_id,$request->all()));
    }

    public function destroy($product_id)
    {
        return $this->successResponse((bool) $this->productRepository->delete($product_id));
    }
}

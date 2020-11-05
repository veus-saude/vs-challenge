<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $repository;

    public function __construct(ProductRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }
    
    public function index(Request $request)
    {
        $products = $this->repository->get($request);

        return response()->json($products, 200);
    }

    public function show($id)
    {
        $product = $this->repository->getId($id);
        
        return response()->json($product, 200);
    }

    public function store(ProductRequest $request)
    {   
        $id = $this->repository->store($request->all());

        return response()->json([
            'success' => 'New product(id -> '.$id.')'
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $this->repository->update($request->all(), $id);

        return response()->json(['success' => 'Update successfully'], 200);
    }

    public function destroy($id)
    {
        $this->repository->destroy($id);
        
        return response()->json(['success' => 'Product deleted'], 200);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Product;
use Validator;
use App\Repositories\Contracts\ProductRepositoryInterface;

class ProductController extends BaseController
{
    private $model = null;

    public function __construct(ProductRepositoryInterface $product)
    {
        $this->model = $product;
    }    

    public function index(Request $request)
    {     
        $products = $this->model->getAll($request);
        return $this->sendResponse($products->toArray(), 'Products retrieved successfully.');
    }

    public function store(Request $request)
    {        
         $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:products',
            'brand_id' => 'required|max:255',
            'price' => 'required|numeric',
            'quantity' =>'required|integer',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
             
        $product = $this->model->create($request->only($this->model->getFields()));

        return $this->sendResponse($product->toArray(), 'Product created successfully.');
    }

    public function show($id)
    {
        $product = $this->model->getById($id);

        if (is_null($product)) {
            return $this->sendError('Product not found.');
        }

        return $this->sendResponse($product->toArray(), 'Product retrieved successfully.');
    }

    public function update(Request $request, Product $product)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:products,name,'.$product->id,
            'brand_id' => 'required|max:255',
            'price' => 'required|numeric',
            'quantity' =>'required|integer',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $product = $this->model->update($product, $request->only($this->model->getFields()));     

        return $this->sendResponse($product->toArray(), 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        $this->model->delete($product);

        return $this->sendResponse($product->toArray(), 'Product deleted successfully.');
    }
   

}

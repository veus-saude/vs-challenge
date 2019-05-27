<?php

namespace App\Http\Model\Product;

use App\Http\Model\Product\ProductModel;

class ProductRepository
{
	private $model;
    
    public function __construct(ProductModel $model){
    	$this->model=$model;
    }

    public function getAllProduct(){
    	return $this->model->with(['brand'])->orderBy('product_id')->get();
    }

    public function getProduct($product_id){
    	return $this->model->with(['brand'])->find($product_id);
    }

    public function createProduct($array){
    	return $this->model->create($array);
    }

    public function editProduct($product_id,$array){
    	$product=$this->model->find($product_id);
    	$product->fill($array);
    	return $product->save();
    }

    public function deleteProduct($product_id){
    	$product=$this->model->find($product_id);
    	return $product->delete();
    }
}

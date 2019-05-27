<?php

namespace App\Http\Model\Brand;

use App\Http\Model\Brand\BrandModel;

class BrandRepository
{
	private $model;
    
    public function __construct(BrandModel $model){
    	$this->model=$model;
    }

    public function getBrandList(){
    	return $this->model->orderBy('brand_id')->pluck('brand_name','brand_id')->toArray();
    }

    public function createBrand($array){
    	return $this->model->create($array);
    }

    public function editBrand($brand_id,$array){
    	$product=$this->model->find($brand_id);
    	$product->fill($array);
    	return $product->save();
    }
}

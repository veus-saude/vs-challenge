<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Model\Product\ProductRepository;
use App\Http\Model\Brand\BrandRepository;


class ProductController extends Controller
{

    private $productRepo;
    private $brandRepo;

    public function __construct(ProductRepository $productRepo,
                                BrandRepository $brandRepo)
    {
        $this->productRepo=$productRepo;
        $this->brandRepo=$brandRepo;
    }

    public function home(){
        $products=$this->productRepo->getAllProduct();
    	return view('product.index',compact('products'));
    }

    public function add(){
    	$brand_list=$this->brandRepo->getBrandList();
    	return view('product.add',compact('brand_list'));
    }

    public function addStore(){
    	
    }

    public function edit($product_id){
        $product=$this->productRepo->getProduct($product_id);
    	$brand_list=$this->brandRepo->getBrandList();
        return view('product.edit',compact('product','brand_list'));
    }

    public function editStore(){

    }

    public function delete(){
    	
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Model\Product\ProductRepository;
use App\Http\Model\Brand\BrandRepository;
use Redirect;


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

    public function addStore(Request $request){
        $validatedData = $request->validate([
        'product_name' => 'required|max:255',
        'brand_id' => 'required',
        'product_price' => 'required',
        'product_qty' => 'required',
        ]);    	
        $product=$this->productRepo->createProduct($request->except('_token'));
        return Redirect::route('edit',$product->product_id); 
    }

    public function edit($product_id){
        $product=$this->productRepo->getProduct($product_id);
    	$brand_list=$this->brandRepo->getBrandList();
        return view('product.edit',compact('product','brand_list'));
    }

    public function editStore($product_id,Request $request){
        $this->productRepo->editProduct($product_id,$request->except('_token'));
        return Redirect::route('edit',$product_id); 
    }

    public function delete($product_id){
    	$this->productRepo->deleteProduct($product_id);
        return Redirect::back(); 
    }
}

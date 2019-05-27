<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Model\Brand\BrandRepository;
use Redirect;


class BrandController extends Controller
{

    private $brandRepo;

    public function __construct(BrandRepository $brandRepo)
    {
        $this->brandRepo=$brandRepo;
    }

    public function home(){
        $brands=$this->brandRepo->getAllBrand();
    	return view('brand.index',compact('brands'));
    }

    public function add(){
    	$brand_list=$this->brandRepo->getBrandList();
    	return view('brand.add',compact('brand_list'));
    }

    public function addStore(Request $request){
        $validatedData = $request->validate([
        'brand_name' => 'required|max:255',
        ]);    	
        $brand=$this->brandRepo->createBrand($request->except('_token'));
        return Redirect::route('brand.edit',$brand->brand_id); 
    }

    public function edit($brand_id){
        $brand=$this->brandRepo->getBrand($brand_id);
        return view('brand.edit',compact('brand'));
    }

    public function editStore($brand_id,Request $request){
        $this->brandRepo->editBrand($brand_id,$request->except('_token'));
        return Redirect::route('brand.edit',$brand_id); 
    }
}

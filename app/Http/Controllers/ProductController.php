<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Product;

class ProductController extends Controller
{
    public function store(Request $request){
        try{
            $product = new Product();
            $product->name = $request->name;
            $product->brand = $request->brand;
            $product->price = $request->price;
            $product->stock = $request->stock;
            $product->save();
            return json_encode(['message' => 'Product saved successfully']);
        }catch(\Exception $e){
            return json_encode($e->getMessage());
        }
    }
    public function show(Request $request){
        if(!isset($request->ordenation)){
            $ordenation = "id";
        }
        else{
            $ordenation = $request->ordenation;
        }
        
        if(!isset($request->pagination)){
            $pagination=10;
        }
        else{
            $pagination = $request->pagination;
        }
        
        if(isset($request->q) && !isset($request->filter)){
            $product = Product::select('id','name','brand','price','stock')->where('name','LIKE','%'.$request->q.'%')->orderBy($ordenation)->paginate($pagination);
        }
        if(!isset($request->q) && isset($request->filter)){
            $filterVector = explode(':',$request->filter);
            $product = Product::select('id','name','brand','price','stock')->where($filterVector[0],'LIKE','%'.$filterVector[1].'%')->orderBy($ordenation)->paginate($pagination);
        }
        if(isset($request->q) && isset($request->filter)){
            $filterVector = explode(':',$request->filter);
            $product = Product::select('id','name','brand','price','stock')->where('name','LIKE','%'.$request->q.'%')->where($filterVector[0],'LIKE','%'.$filterVector[1].'%')->orderBy($ordenation)->paginate($pagination);
        }
        if(!isset($request->q) && !isset($request->filter)){
            $product = Product::select('id','name','brand','price','stock')->orderBy($ordenation)->paginate($pagination);
        }
        return json_encode($product);
    }
    public function update(Request $request){
        if(isset($request->id)){
            try{
                $product = Product::find($request->id);
                if(isset($request->name) || isset($request->brand) || isset($request->price) || isset($request->stock)){
                    if(isset($request->name)){
                        $product->name = $request->name;
                    }
                    if(isset($request->brand)){
                        $product->brand = $request->brand;
                    }
                    if(isset($request->price)){
                        $product->price = $request->price;
                    }
                    if(isset($request->stock)){
                        $product->stock = $request->stock;
                    }
                    $product->save();
                    return json_encode(['message' => 'Product edited successfully']);
                }
                else{
                    return json_encode(['message' => 'Please, choose a product attribute to edit.']);
                }
            }catch(\Exception $e){
                return json_encode($e->getMessage());
            }
        }
        else{
            return json_encode(['message' => 'Impossible to edit a product without id request']);
        }
    }
    public function delete(Request $request){
        if(isset($request->id)){
            try{
                if(Product::where('id','=',$request->id)->delete()){
                    return json_encode(['message' => 'Product removed successfully']);
                }
                else{
                        return json_encode(['message' => 'Error has occured while trying to proceed your request']);
                }
            }catch(\Exception $e){
                return json_encode($e->getMessage());
            }
        }
        else{
            return json_encode(['message' => 'Impossible to delete a product without id request']);
        }
    }
}
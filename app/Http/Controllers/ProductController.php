<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return response()->json(Product::all());
    }

    public function store(Request $request)
    {
        $obj = new Product($request->all());
        $obj->save();
        return response()->json($obj,200);
    }

    public function update(Request $request, int $id)
    {
        $product = Product::find($id);
        if($product){
            return response()->json($product->update($request->all()),200);
        }else{
            $msg = 'Não existe o produto com id '.$id;
            return Response()->json($msg,400);
        }
    }

    public function show(int $id)
    {
        $product = Product::find($id);
        if($product){
            return Response()->json($product);
        }else{
            $msg = 'Não existe o produto com id '.$id;
            return Response()->json($msg,400);
        }
    }

    public function destroy(int $id)
    {
        $product = Product::find($id);
        if($product){
            Product::destroy($id);
            return Response()->json(true, 204);
        }else{
            $msg = 'Não existe o produto com id '.$id;
            return Response()->json($msg,400);
        }
    }

    public function search(Request $request)
    {
        $productFilter = Product::getSearchPaginatorOrderby($request);

        return response()->json([
            'totalResults' => $productFilter["totalResults"],
            'list' => $productFilter["list"]
        ]);
    }

}

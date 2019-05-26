<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function search(Request $request)
    {
        $productFilter = Product::getSearchPaginatorOrderby($request);

        return response()->json([
            'totalResults' => $productFilter["totalResults"],
            'list' => $productFilter["list"]
        ]);
    }

    public function index()
    {
        return response()->json(Product::all());
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

}

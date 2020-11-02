<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function searchProduct(Request $request)
    {
        $sort = isset($request->sort) ? $request->sort : 'name,asc';
        $orderBy = explode(',', $sort);
        
        if (isset($request->q) && isset($request->filter)) {
            //https://example.com/api/v1/products?q=seringa&filter=brand:BUNZL&sort=name,desc
            $productName = $request->q;
            $filter = explode(':', $request->filter);
            $productBrand = $filter[1];

            $products = Product::where('name', 'like', $productName.'%')
                               ->orWhere('brand', 'like', $productBrand.'%')
                               ->select('name', 'brand', 'price', 'amount')
                               ->orderBy($orderBy[0], $orderBy[1])
                               ->jsonPaginate();

            return response()->json($products, 200);                               
        }

        $products = Product::select('name', 'brand', 'price', 'amount')
                           ->orderBy($orderBy[0], $orderBy[1])
                           ->jsonPaginate();
        
        return response()->json($products, 200);
    }
}

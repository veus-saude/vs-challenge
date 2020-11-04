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
            $productName = $request->q;
            $filter = explode(':', $request->filter);
            $productBrand = $filter[1];

            $products = Product::where('name', 'like', $productName.'%')
                               ->orWhere('brand', 'like', $productBrand.'%')
                               ->orderBy($orderBy[0], $orderBy[1])
                               ->jsonPaginate();

            return response()->json($products, 200);
        }

        $products = Product::orderBy($orderBy[0], $orderBy[1])
                           ->jsonPaginate();

        return response()->json($products, 200);
    }
}

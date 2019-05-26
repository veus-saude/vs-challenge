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

}

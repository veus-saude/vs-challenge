<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Helpers\QueryBuilderHelper;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $product = new Product();
        $product->name = $request->get('q');
        $product->filters = QueryBuilderHelper::paramsToArray($request->get('filter'));
        $product->sorts = QueryBuilderHelper::paramsToArray($request->get('sort'));
        
        return response()->json($product->getProducts());
    }

}

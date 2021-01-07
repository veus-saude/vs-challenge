<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;

class ProductV0Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $query = Product::query();
        if ($request->has('q')){
            $query->where('name', 'like', '%' . $request->get('q') . '%');
        }
        if ($request->has('filter')){
            $query->Where('brand', "=",$request->get('filter'));
        }

        $products = $query->paginate(20);

        return response([
            'products' => ProductResource::collection($products),
            'pagination' => [
                'total' => $products->total(),
                'perPage' => $products->perPage(),
                'lastPage' => $products->lastPage(),
                'currentPage' => $products->currentPage(),

            ], 'message' => 'Retrieved successfully'
        ], 200);
        }

}

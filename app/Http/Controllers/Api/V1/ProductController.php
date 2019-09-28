<?php

namespace App\Http\Controllers\Api\V1;

use App\Helpers\SearchHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Products\ProductStoreRequest;
use App\Http\Requests\Api\V1\Products\ProductUpdateRequest;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Input;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $params = $request->all();
        return response()->json([
            'success' => true,
            'data' => Product::getWithApiQueryParams($params)
        ]);
    }

    public function show(Request $request, $id)
    {
        return response()->json([
            'success' => true,
            'data' => Product::find($id)
        ]);
    }

    public function store(ProductStoreRequest $request)
    {
        if ($product = Product::create($request->all())){
            return response()->json([
                'success' => true,
                'data' => $product->toArray()
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Product could not be added'
        ], 500);
    }

    public function update(ProductUpdateRequest $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product with id ' . $id . ' not found'
            ], 400);
        }

        $updated = $product->fill($request->all())->save();

        if ($updated){
            return response()->json([
                'success' => true
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Product could not be updated'
        ], 500);
    }

    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product with id ' . $id . ' not found'
            ], 400);
        }

        if ($product->delete()) {
            return response()->json([
                'success' => true
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Product could not be deleted'
        ], 500);
        
    }
}

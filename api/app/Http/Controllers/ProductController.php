<?php

namespace App\Http\Controllers;

use App\Product;

use App\Http\Requests\StoreProduct;
use App\Http\Middleware\ParseInputStream;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $input      = $request->all();
        $products   = Product::searchString($input)
                        ->fieldFilter($input)
                        ->sortFilter($input)
                        ->paginate(2);

        
        return response()->json([
            'success'   => true,
            'data'      => $products
        ]);
    }
 
    public function show($id)
    {
        $product = Product::where('id', $id);
 
        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product with id ' . $id . ' not found'
            ], 400);
        }
 
        return response()->json([
            'success' => true,
            'data' => $product
        ], 400);
    }
 
    public function store(StoreProduct $request)
    {
 
        $product = $request->all();
        $stored = Product::create($product);
        if ($stored)
            return response()->json([
                'success' => true,
                'data' => $stored
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Product could not be added'
            ], 500);
    }
 
    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product with id ' . $id . ' not found'
            ], 400);
        }

        $params = [];
        new ParseInputStream($params);

        $updated = $product->fill($params)->save();
 
        if ($updated)
            return response()->json([
                'success' => true
            ]);
        else
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
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Product could not be deleted'
            ], 500);
        }
    }
}
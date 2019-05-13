<?php

namespace App\Http\Controllers\API\v1;

use App\Helpers\SearchHelper;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Input;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $product = new Product();
        $product->name = $request->get('q');
        $product->filters = SearchHelper::queryParamToArray($request->get('filter'));
        $product->sorts = SearchHelper::queryParamToArray($request->get('sort'));

        return response()->json([
            'success' => true,
            'data' => $product->getProducts()
        ]);
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'price' => 'required|numeric',
            'brand' => 'required',
            'quantity' => 'required|integer',
        ]);

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

    public function update(Request $request, $id)
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

<?php

namespace App\Http\Controllers\v1;

use App\Helpers\QueryHelper;
use App\Product;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller;

class ProductsController extends Controller
{
    public function index(Request $request)
    {
        $product = new Product();

        $product->name = $request->get('q');
        $product->filters = QueryHelper::paramsToArray($request->get('filter'));
        $product->sortBy = $request->get('sortBy');
        $product->perPage = $request->get('perPage');

        return response()->json([
            'success' => true,
            'data' => $product->getProducts(),
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

        if ($product = Product::create($request->all())) {
            return response()->json([
                'success' => true,
                'data' => $product->toArray(),
            ], 201);
        }

        return response()->json([
            'success' => false,
            'message' => 'Product could not be added',
        ], 500);
    }

    public function show(int $id)
    {
        if (!$product = Product::find($id)) {
            return response()->json([
                'success' => false,
                'message' => 'Product with id ' . $id . ' not found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $product->toArray(),
        ]);
    }

    public function update(Request $request, $id)
    {
        if (!$product = Product::find($id)) {
            return response()->json([
                'success' => false,
                'message' => 'Product with id ' . $id . ' not found',
            ], 404);
        }

        if ($updated = $product->fill($request->all())->save()) {
            return response()->json([
                'success' => true,
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => 'Product could not be updated',
        ], 500);
    }

    public function destroy($id)
    {
        $removed = Product::destroy($id);
        if ($removed > 0) {
            return response()->json([
                'success' => true,
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Failed to delete product with id ' . $id,
        ], 400);
    }
}

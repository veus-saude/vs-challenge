<?php

namespace App\Http\Controllers\v2;

use App\Brand;
use App\Product;
use Illuminate\Http\Request;
use Monolog\Handler\IFTTTHandler;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\ProductUpdateRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate(
            Request()->query('q'),
            Request()->query('filter'),
            Request()->query('per_page')
        );

        if ($products) {
            return response()->json(compact('products'), 200);
        }

        return response()->json(["message" => "Search returned 0 results"], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        try {

            $brand = Brand::find($request->brand_id);

            $product = new Product();
            $product->name = $request->name;
            $product->price = $request->price ?? 0;
            $product->quantity = $request->quantity ?? 0;

            $product->brand()->associate($brand);

            $product->save();

            return response()->json(["data" => compact('product')], 200);

        } catch (\Exception $e) {

            Log::error($e);

            return response()->json(["message" => "Error"], 500);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  Product Product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return response()->json(["data" => compact($product)], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Product Product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductUpdateRequest $request, Product $product)
    {
        try {

            if ( count($request->all()) ) {

                $request->name ? $product->name = $request->name : '';
                $request->price ? $product->price = $request->price : '';
                $request->quantity ? $product->quantity = $request->quantity : '';
                $request->quantity ? $product->brand()->associate( Brand::find($request->brand_id) ) : '';

                $product->save();

            }

            return response()->json(["data" => compact('product')], 200);

        } catch (\Exception $e) {

            Log::error($e);

            return response()->json(["message" => "Error"], 500);

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Product Product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        try {

            $product->delete();

            return response()->json(["message" => "Product deleted"], 200);

        } catch (\Exception $e) {

            Log::error($e);

            return response()->json(["message" => "Error"], 500);

        }
    }
}

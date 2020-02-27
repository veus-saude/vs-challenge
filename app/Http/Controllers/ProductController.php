<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $input = $request->all();

        $products = Product::search($input)
            ->filter($input)
            ->sort($input)
            ->paginates($input);

        return response()->json([
            'success' => true,
            'data' => $products,
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try {
            $product = new Product();
            $product->fill($request->all());
            $product->save();

            return response()->json([
                'success' => true,
                'data' => $product], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Bad request',
                'exception' => $th,
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::where('id', $id)->first();
        if ($product) {
            return response()->json([
                'success' => true,
                'data' => $product,
            ]);
        } else {
            return response()->json([
                'message' => 'Record not found',
            ], 404);
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'message' => 'Record not found',
            ], 404);
        }
        try {
            $product->fill($request->all());
            $product->save();
            return response()->json($product);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Bad request',
                'exception' => $th,
            ], 400);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'message' => 'Record not found',
            ], 404);
        }
        try {

            $product->delete();
            return response()->json([
                'message' => 'Deleted successfully',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Bad request',
                'exception' => $th,
            ], 400);
        }

    }

}

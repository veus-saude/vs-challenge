<?php

namespace App\Http\Controllers\API\v1;

use Validator;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    protected $limitPerPage = 15;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            if (isset($request->limit)) {
                $this->limitPerPage = $request->limit;
            }
            $products = Product::search($request->all());
            $data = $products;
            return response()->json($data, 200);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => 'product not found',
                'devError' => $th->getMessage()
            ], 404);
        }
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
            $validator = Validator::make($request->all(), [ 
                'name' => 'required', 
                'brand' => 'required', 
                'price' => 'required', 
                'quantity' => 'required|min:1', 
            ]);
            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 401);            
            }
    
            $input = $request->all();
            $product = Product::create($input);
            $data = [
                'success' => 'product created successfully.',
                'data' => $product
            ];
            return response()->json($data, 200);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => 'product not created.',
                'devError' => $th->getMessage()
            ], 404);
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
        //
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
        try {
            $input = $request->all();
            $product = Product::find($id)->update($input);
            $data = [
                'success' => 'product updated successfully.',
                'data' => $product
            ];
            return response()->json($data, 200);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => 'product not updated.',
                'devError' => $th->getMessage()
            ], 404);
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
        try {
            $product = Product::find($id)->delete();
            $data = [
                'success' => 'product deleted successfully.',
                'data' => $product
            ];
            return response()->json($data, 200);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => 'product not deleted.',
                'devError' => $th->getMessage()
            ], 404);
        }
    }
}

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
        $product = new Product();

        if (isset($input['q'])){
            $product = $product->where('name','like','%'.$input['q'].'%');
        }

        if (isset($input['filter'])){
            $filter = explode(':',$input['filter']);
            $product = $product->where($filter[0],$filter[1]);
        }

        if (isset($input['price'])){
            $price = explode(':',$input['price']);

        }

        if(isset($input['sort'])){
            $product = $product->orderBy($input['sort']);
        } else {
            $product = $product->orderBy('name');
        }

        $product = $product->paginate(15);

        return response()->json($product);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'brand' => 'required|max:255',
            'price' => 'required',
            'stock' => 'required|integer'
        ]);

        try {
            $product = Product::create($request->all());

            return response()->json($product, 201);
        } catch (\Exception $exception){
            return response()->json([
                'message' => 'Error on new product',
                'error' => $exception
            ],500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return $product;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
    public function update(Request $request, Product $product)
    {

        $request->validate([
            'name' => 'required|max:255',
            'brand' => 'required|max:255',
            'price' => 'required',
            'stock' => 'required|integer'
        ]);
            $product->update($request->all());
            return response()->json($product,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        try{
            $product->delete();
            return response()->json([
                'message' => 'Successfully deleted product!'
            ],204);
        } catch (\Exception $exception){
            return response()->json([
                'message' => 'Error on delete product',
                'error' => $exception
            ],500);
        }
    }
}

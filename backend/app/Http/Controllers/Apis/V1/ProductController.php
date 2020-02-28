<?php

namespace App\Http\Controllers\Apis\V1;

use App\Http\Controllers\Controller;
use App\Product;
use App\Search\Search;
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
        if($request->q || $request->filter)
        {
            $results = Search::find($request->q)
            ->filter($request->filter)
            ->setPagination(4)
            ->results();

            return response()->json($results);
        }
        else
        {
            return response()->json(Product::paginate(4));
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
        $request->validate([
            'nome' => 'required|string|min:3|max:150',
            'brand' => 'required|string|min:3|max:100',
            'preco' => 'required',
            'estoque' => 'required',
        ]);

        $product = Product::create($request->all());

        return response()->json($product);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $product->update($request->all());
        return response()->json($product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        return $product->delete()
        ? response()->json(['message' => 'produto removido com sucesso'])
        : response()->json(['message' => 'produto não foi removido com sucesso'], 400);
    }
}

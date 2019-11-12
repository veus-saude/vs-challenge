<?php

namespace App\Http\Controllers\v1;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = (new Product)->newQuery();

        if($request->has('q')){
            $query
                ->where('name', '~*', $request->query('q'));
        }

        if($request->has('filter')){
            $filter = explode(':', $request->query('filter'));
            $query->where($filter[0], '~*', $filter[1]);
        }

        if($request->has('order')){
            $order = explode(':', $request->query('order'));
            $query->orderBy($order[0], $order[1]);
        }

        if($request->has('page') && $request->has('size')){
            $page = $request->query('page') < 0 ? 0 : $request->query('page') - 1;
            $pageSize = $request->query('size') <= 0 ? 1 : $request->query('size');
            $query->offset($page * $pageSize)->limit($pageSize);
        }

        return $query->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return Product::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return $product;
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
        if( $product->update($request->all()) )
            return $product;
        return false;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return $product;
    }
}

<?php

namespace App\Http\Controllers;

use App\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * @var ProductService
     */
    protected $service;

    /**
     * Construtor
     */
    public function __construct(ProductService $service) {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $params = $request->only(['q', 'filter', 'page', 'perPage']);

        $products = $this->service->list($params);

        return response()->json($products);
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
            $product = json_decode($request->getContent(), true);
            $response = $this->service->save($product);
            return response()->json(['success' => $response]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
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
        try {
            $data       = json_decode($request->getContent(), true);
            $data['id'] = $product->id;
            $response = $this->service->update($data);
            return response()->json(['success' => $response]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}

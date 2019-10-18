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
        $params = $request->only(['q', 'filter', 'page', 'perPage', 'sort']);

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
     * @param  int $productId
     * @return \Illuminate\Http\Response
     */
    public function show($productId)
    {
        $product = $this->service->find($productId);
        if (!empty($product)) {
            return response()->json($product);
        } else {
            return response()->json(['error' => 'Product not found'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $productId)
    {
        try {
            $data       = json_decode($request->getContent(), true);
            $data['id'] = $productId;
            $response = $this->service->update($data);
            return response()->json(['success' => $response]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $productId
     * @return \Illuminate\Http\Response
     */
    public function destroy($productId)
    {
        try {
            $product = $this->service->find($productId);

            if (!empty($product)) {
                $response = $this->service->delete($productId);
                return response()->json(['success' => $response]);
            } else {
                return response()->json(['error' => 'Product not found'], 404);
            }
        } catch(\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}

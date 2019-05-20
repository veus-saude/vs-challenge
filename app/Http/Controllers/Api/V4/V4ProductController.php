<?php

namespace App\Http\Controllers\Api\V4;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\IndexProductGet;

class V4ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param IndexProductGet $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(IndexProductGet $request)
    {
        $products = Product::query();

        if ($request->has('filter')) {
            $filter = $request->get('filter');
            $unit_price_lte = key_exists('max_unit_price', $filter) ? '|lte:max_unit_price' : '';
            $quantity_lte = key_exists('max_quantity', $filter) ? '|lte:max_quantity' : '';

            \Validator::make($filter, [
                'name' => 'sometimes|required|string|max:150',
                'brand' => 'sometimes|required|string|max:150',
                'min_unit_price' => "sometimes|required|numeric|min:0|max:9999999$unit_price_lte",
                'max_unit_price' => 'sometimes|required|numeric|min:0|max:9999999',
                'min_quantity' => "sometimes|required|integer|min:0|max:999999999$quantity_lte",
                'max_quantity' => 'sometimes|required|integer|min:0|max:999999999',
            ])->validate();

            if (key_exists('name', $filter))
                $products->where('name', 'like', "%{$filter['name']}%");
            if (key_exists('brand', $filter))
                $products->where('brand', 'like', "%{$filter['brand']}%");
            if (key_exists('min_unit_price', $filter))
                $products->where('unit_price', '>=', $filter['min_unit_price']);
            if (key_exists('max_unit_price', $filter))
                $products->where('unit_price', '<=', $filter['max_unit_price']);
            if (key_exists('min_quantity', $filter))
                $products->where('quantity', '>=', $filter['min_quantity']);
            if (key_exists('max_quantity', $filter))
                $products->where('quantity', '<=', $filter['max_quantity']);
        }

        if ($request->has('q')) {
            $search = $request->get('q');

            $products->where(function ($query) use ($search) {
                $query->where('name', 'like', "%$search%")
                    ->orWhere('brand', 'like', "%$search%");
            });
        }

        if ($request->has('sort')) $products->orderBy($request->get('sort'));

        //dump($products->toSql());
        //dd($products->getBindings());

        return response()->json($products->paginate());
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

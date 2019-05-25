<?php

namespace App\Http\Controllers;

use App\Repositories\ProductRepositoryContract as ProductRepository;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function all(Request $request, ProductRepository $products)
    {
        return response()->json(
            $products->all(
                $request->query("q"),
                $request->query("filter"),
                $request->query("sort"),
                $request->query("page")
            )
        );
    }

    public function get($id, ProductRepository $products)
    {
        return $products->findOrFail($id);
    }

    public function create(Request $request, ProductRepository $products)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'price' => 'required|numeric|between:0.01,9999.99',
            'thumbnail' => 'required|string|max:255',
            'quantity' => 'required|integer'
        ]);

        return response()->json($products->create($request->all()));
    }

    public function update($id, Request $request, ProductRepository $products)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'price' => 'required|numeric|between:0.01,9999.99',
            'thumbnail' => 'required|string|max:255',
            'quantity' => 'required|integer'
        ]);

        return response()->json($products->update($id, $request->all()));
    }

    public function delete($id, ProductRepository $products)
    {
        $products->delete($id);

        return response()->json();
    }
}

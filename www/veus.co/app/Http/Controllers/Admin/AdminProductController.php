<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Resources\ProductResource;
use Illuminate\Support\Facades\Validator;

class AdminProductController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Product::query();
        if ($request->has('q')) {
            $query->where('name', 'like', '%' . $request->get('q') . '%')
                ->orWhere('brand', 'like', '%' . $request->get('q') . '%');
        }
        if ($request->has('filter')) {
            $query->Where('brand', $request->get('filter'));
        }

        $products = $query->paginate();
        return view('admin.products.index', compact("products"));
    }


    public function create()
    {
        return view('admin.products.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'brand' => 'required|max:255',
            'qty' => 'required|numeric',
            'price' => 'required|numeric'
        ]);
        $product =  Product::create($request->all());

        return redirect('/products')->with('success', 'Product Criada com Sucesso.');;
    }


    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }


    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }


    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|max:255',
            'brand' => 'required|max:255',
            'qty' => 'required|numeric',
            'price' => 'required|numeric'

        ]);
        $product->update($request->all());

        return redirect()->route('admin.products.index')
            ->with('success', 'Product Atualizada com sucesso');
    }


    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Product apagada com sucesso');
    }
    public function restore(Product $product)
    {
        // Restaura:
        $product->restore();
        return redirect()->route('admin.products.index')
            ->with('success', 'Product Restaurada com sucesso');
    }

    public function onlyTrashed()
    {
        $productsTrashed = Product::onlyTrashed()->get();
        return view('admin.products.trashed', compact('productsTrashed'));
    }

    public function forceDelete(Product $product)
    {

        // Deleta definitivamente:
        $product->forceDelete();
        return redirect()->route('admin.products.index')
            ->with('success', 'Product apagada definitivamente');
    }
}

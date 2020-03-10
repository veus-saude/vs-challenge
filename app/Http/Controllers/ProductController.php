<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        
        return view('products.index', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), $this->rules(), $this->messages());
        
        if ($validate->fails()) {
            return redirect()
                ->route('products.create')
                ->withInput()
                ->withErrors($validate);
        }
        
        $product = new Product();
        $product->name = $request->name;
        $product->brand = $request->brand;
        $product->price = str_price($request->price);
        $product->quantity = intval($request->quantity);
        
        if (!$product->save()) {
            
            return redirect()
                ->route('products.create')
                ->withInput()
                ->with('error', 'Erro ao tentar cadastrar, por favor, verifique os dados.');
        }
        
        return redirect()
            ->route('products.index')
            ->with('success', 'Produto cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        
        if (!$product) {
            return redirect()->route('products.index');
        }
        
        return view('products.show', ['product' => $product]);
    }

    /**
     * 
     * @param Product $product
     * @return type
     */
    public function edit(Product $product)
    {
        return view('products.edit', ['product' => $product]);
    }

    /**
     * 
     * @param Request $request
     * @param int $id
     * @return type
     */
    public function update(Request $request, $id)
    {   
        $product = Product::find($id);
        
        if (!$product) {
            return redirect()->route('products.index');
        }
        
        $validate = Validator::make($request->all(), $this->rules(), $this->messages());
        
        if ($validate->fails()) {
            
            return redirect()
                ->route('products.edit', $id)
                ->withInput()
                ->withErrors($validate);
        }
        
        $product->name = $request->name;
        $product->brand = $request->brand;
        $product->price = str_price($request->price);
        $product->quantity = intval($request->quantity);
        
        if (!$product->save()) {
            
            return redirect()
                ->route('products.edit', $id)
                ->withInput()
                ->with('error', 'Erro ao tentar editar, por favor, verifique os dados.');
        }
        
        return redirect()
            ->route('products.index')
            ->with('success', 'Produto alterado com sucesso!');
    }

    /**
     * 
     * @param Product $product
     * @return type
     */
    public function destroy(Product $product)
    {
        Product::destroy($product->id);
        
        return redirect()
            ->route('products.index')
            ->with('success', 'Produto removido com sucesso!');
    }
    
    public function destroySelected(Request $request)
    {
        if (!empty($request->ids)) {
            Product::destroy($request->ids);
            session()->flash('success', 'Produto(s) removido(s) com sucesso!');
            return;
        }
        
        session()->flash('error', 'Não foi possível excluir os produtos selecionados.');
        return;
    }
    
    /**
     * Validation rules
     * @return array
     */
    private function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'price' => 'required',
            'quantity' => 'required|integer'
        ];
    }
    
    /**
     * Validation rules messages
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Por favor, insira o nome do produto',
            'brand.required' => 'Por favor, insira a marca do produto',
            'price.required' => 'Por favor, insira o preço do produto',
            'quantity.required' => 'Por favor, insira a quantidade do produto'
        ];
    }
}

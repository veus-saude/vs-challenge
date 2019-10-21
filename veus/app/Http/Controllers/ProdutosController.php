<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\ProductsController as ApiProducts;

class ProdutosController extends ApiProducts
{
    public function view(Request $request){
        $response = parent::index($request);
        return view('produtos/index')->with('produtos', $response);
    }

    public function store(Request $request){
        $this->create($request);
        return redirect()->action('ProdutosController@view');
    }

    public function create(Request $request){
        parent::store($request);
    }

    public function update(Request $request, $id){
        parent::update($request, $id);

        return redirect()->action('ProdutosController@view');
    }

    public function new(){
        return view('produtos.form');
    }

    public function edit($id){
        $produto = parent::show($id);
        return view('produtos.edit')->with('produto', $produto);
    }

    public function delete($id){
        parent::destroy($id);
        return redirect()->action('ProdutosController@view');
    }
}

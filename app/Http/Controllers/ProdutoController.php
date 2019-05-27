<?php

namespace App\Http\Controllers;

use App\Produto;
use Illuminate\Http\Request;
use App\Http\Resources\Produto as ProdutoResource;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produtos = Produto::orderBy('created_at', 'desc')->paginate(5);
        return ProdutoResource::collection($produtos);
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
        // return $request;
        $produto = new Produto();

        $produto->nome = $request->nome;
        $produto->marca_id = $request->marca_id;
        $produto->preco = $request->preco;
        $produto->quantidade = $request->quantidade;
        $produto->descricao = $request->descricao;

        if ($produto->save()) {
            return new ProdutoResource($produto);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function show(Produto $produto)
    {
        $produto = Produto::findOrFail($produto);
        return new ProdutoResource($produto);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function edit(Produto $produto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produto $produto)
    {
        $produto = Produto::find($produto)->first();
        $produto->nome = $request->nome;
        $produto->marca_id = $request->marca_id;
        $produto->preco = $request->preco;
        $produto->quantidade = $request->quantidade;
        $produto->descricao = $request->descricao;
        $produto->save();

        return new ProdutoResource($produto);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produto $produto)
    {
        $produto->delete();
        return new ProdutoResource($produto);
    }
}

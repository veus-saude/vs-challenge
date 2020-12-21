<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Http\Requests\ProdutoRequest;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $produto)
    {
        try {       
            $produtoModal = new Produto();
            $response = $produtoModal->allProduto($produto);
            return response()->json($response);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erro ao Enviar ' . $e->getMessage()
            ], 400);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProdutoRequest $produto)
    {
        try {
            $produtoModal = new Produto();
            $retorno = $produtoModal->insertProduto($produto);
            return response()->json($retorno,201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erro ao Enviar ' . $e->getMessage()
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $produtoModal = new Produto();
            $response = $produtoModal->findProduto($id);
            return response()->json($response,200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erro ao Enviar ' . $e->getMessage()
            ], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function update($id,ProdutoRequest $produto)
    {
        try {
            $produtoModal = new Produto();
            $retorno = $produtoModal->updateProduto($produto,$id);
            return response()->json($retorno,200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erro ao Enviar ' . $e->getMessage()
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            
            Produto::findOrFail($id);
            $produtoModal = new Produto();
            $response = $produtoModal->deleteProduto($id);
            return response()->json($response,302);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erro ao Enviar ' . $e->getMessage()
            ], 302);
        }
    }
}

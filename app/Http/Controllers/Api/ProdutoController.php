<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\ProdutoRequest;
use App\Produto;
use App\Repositories\ProdutoRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProdutoController extends Controller
{
    /**

     * @var Produto
     */
    private $produto;

    public function __construct(Produto $produto)
    {
        $this->produto = $produto;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, ProdutoRepository $produtos)
    {

        // Caso tenha filtros para busca
        if($request->has('filter')){
            $produtos::condicoesDeBusca($request);
        }

        // Caso ordenacao
        if($request->has('order')){
            $produtos::ordenacao($request);
        }

        // Caso queira selecionar determinados campos
        if($request->has('fields')) {
            $produtos::selecionarCampos($request);
        }
        return response()->json($produtos->paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProdutoRequest $request)
    {
        $dados = $request->all();
        $produto = $this->produto->create($dados);
        return response()->json($produto);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $produto = $this->produto->find($id);
        return response()->json($produto);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProdutoRequest $request, $id)
    {
        $dados = $request->all();
        $produto = $this->produto->findOrFail($dados['id']);
        $produto->update($dados);
        return response()->json($produto);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->produto->findOrFail($id)->delete();
        return response()->json(['data' => ['msg' => 'Produto excluido com sucesso!']]);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Produto;
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

    public function index(){
        $produtos = $this->produto->all();
        return response()->json($produtos);
    }

    public function salvar(Request $request){
        $dados = $request->all();
        $produto = $this->produto->create($dados);
        return response()->json($produto);
    }

    public function listarProdutoPorId($id){
        $produto = $this->produto->find($id);
        return response()->json($produto);
    }

    public function atualizar(Request $request){
        $dados = $request->all();
        $produto = $this->produto->findOrFail($dados['id']);
        $produto->update($dados);
        return response()->json($produto);
    }

    public function deletar($id){
        $this->produto->findOrFail($id)->delete();
        return response()->json(['data' => ['msg' => 'Produto excluido com sucesso!']]);
    }


}

<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProdutoRequest;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProdutoController extends Controller
{

    public function index(Request $request)
    {
        $produtos = new Produto;
        $busca_produtos = $produtos->filtroProdutos($request);
        return response()->json($busca_produtos->paginate(10)->withQueryString());
    }

    public function store(ProdutoRequest $request)
    {
        $dados_inputs = $request->all();
        $produto_insert = Produto::create($dados_inputs);
        abort_if(!$produto_insert, 500, 'Erro ao inserir produto');

        $produto = Produto::where('id', $produto_insert->id)->first();
        return response()->json($produto, 201);
    }

    public function show(Request $request, $id)
    {
        $produtos = new Produto;
        $busca_produtos = $produtos->filtroProdutos($request);
        return response()->json($busca_produtos->where('id', $id)->firstOrFail());
    }

    public function update(ProdutoRequest $request, $id)
    {
        $produto = Produto::findOrFail($id);
        $dados_inputs = $request->all();
        $produto_update = $produto->fill($dados_inputs)->update();
        abort_if(!$produto_update, 500, 'Erro ao editar produto');

        return response()->json(Produto::where('id', $id)->firstOrFail());
    }

    public function destroy($id)
    {
        $produto = Produto::findOrFail($id);
        $produto->delete();
        return response()->json(['message'=>'Produto: ' . $id . ' deletado.'], 204);
    }
}

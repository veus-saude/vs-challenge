<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Produtos;
use App\Repository\ProdutosRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class ProductApiController extends Controller
{
    public function index(Request $request){
        try {

            $pRepository = new ProdutosRepository();
            $q = $request->query("q", "");
            $filter = $request->query("filter", "");
            $order = $request->query("order", "");

            $pFilter = [];
            if($filter != ""){
                $filter = explode(":", $filter);
                $pFilter = [
                    "column" => $filter[0],
                    "value" => $filter[1]
                ];
            }

            $lista = $pRepository->buscar($q, $pFilter, $order)->paginate(1);//->sortBy("nome")->values()->all();
                ;
            return response()->json($lista);

        }catch (\Exception $e){
            Log::error("ERRO::PRODUCTAPI - BUSCAR", [ 'erro' => $e->getMessage()]);
            return response()->json(['message' => 'Erro ao buscar os produtos' . $e->getMessage()], 500);
        }
    }

    public function cadastrar(Request $request){

        try {
            $p = new Produtos($request->all());
            if($p->validate($request->all())) {
                $p->fill($request->all());
                if ($p->save())
                    return response()->json(['message' => 'Produto salvo com sucesso']);
                else
                    return response()->json(['message' => 'Produto não salvo'], 500);
            }else{
                return response()->json($p->errors(), 500);
            }
        }catch (\Exception $e){
            Log::error("ERRO::PRODUCTAPI - SALVAR", [ 'erro' => $e->getMessage()]);
            return response()->json(['message' => 'Erro ao salvar um produto'], 500);
        }
    }

    public function findone(Request $request, $id = 0){
        try {
            $p = Produtos::find($id);
            if($p){
                return response()->json(['p' => $p]);
            }else{
                return response()->json(['p' => null, 'message' => 'Produto não encontrado']);
            }

        }catch (\Exception $e){
            Log::error("ERRO::PRODUCTAPI - BUSCAR POR ID", [ 'erro' => $e->getMessage()]);
            return response()->json(['message' => 'Erro ao buscar um produto'], 500);
        }
    }

    public function update(Request $request, $id = 0){
        try {
            $p = Produtos::find($id);
            if($p){
                $p->fill($request->all());
                $p->save();
                return response()->json(['message' => 'Produto atualizado com sucesso']);
            }else{
                return response()->json(['message' => 'Produto não encontrado']);
            }

        }catch (\Exception $e){
            Log::error("ERRO::PRODUCTAPI - ATUALIZAR", [ 'erro' => $e->getMessage()]);
            return response()->json(['message' => 'Erro ao atualizar um produto'], 500);
        }
    }

    public function delete(Request $request, $id = 0){

        try {
            $p = Produtos::find($id);
            if($p){
                $p->delete();
                return response()->json(['message' => 'Produto deletado com sucesso']);
            }else{
                return response()->json(['message' => 'Produto não encontrado']);
            }

        }catch (\Exception $e){
            Log::error("ERRO::PRODUCTAPI - DELETAR", [ 'erro' => $e->getMessage()]);
            return response()->json(['message' => 'Erro ao deletar um produto'], 500);
        }
    }
}

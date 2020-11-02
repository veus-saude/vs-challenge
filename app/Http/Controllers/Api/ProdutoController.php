<?php

namespace App\Http\Controllers\Api;

use App\Helpers\QueryHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Produto;

use Validator;

class ProdutoController extends Controller
{
    
    private $produto;

    public function __construct(Produto $produto){
        $this->produto = $produto;
    }   


    public function index(Request $request)
    {
     
        $produto = new Produto();

        $produto->nome = $request->get('q');
        $produto->filters = $request->get('filter');
        
        $produto->sortBy = $request->get('sortBy');
        $produto->perPage = $request->get('perPage');
        return response()->json([
            'success' => true,
            'data' => $produto->getProdutos(),
        ]);
       
       
     
        // $produto = $this->produto::paginate(5);
        // return response()->json($produto);
    }

    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|unique:produtos,nome',
            'preco' => 'required',
            'quantidade' => 'required|integer',
            'marca_id' => 'required|integer'
            
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 422);
        }
        $produto = new $this->produto;
        $produto->nome = $request->nome;
        $produto->preco = $request->preco;
        $produto->quantidade = $request->quantidade;
        $produto->marca_id = $request->marca_id;
        $produto->save();
        return response()->json(['message'=>'Produto criada com sucesso!', 'Produto' => $produto], 201);
    }

   
    public function show($id)
    {
        if( !$produto = $this->produto::find($id) )
            return response()->json(['error' => 'Produto não encontrada'], 404);
        
        return response()->json($produto);
    }

  
    public function update(Request $request, $id)
    {
        if( !$produto = $this->produto::find($id) )
            return response()->json(['error' => 'Produto não encontrada'], 404);

        $validator = Validator::make($request->all(), [
            'nome' => 'unique:produtos,nome',
            'preco' => 'numeric',
            'quantidade' => 'integer',
            'marca_id' => 'integer'
        ]);
        
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 422);
        }

        $produto->update($request->all());

        return response()->json(['message'=>'Produto Atualizado com sucesso!', 'Produto' => $produto], 200);
    }

    public function destroy($id)
    {
        if( !$produto = $this->produto::find($id) )
            return response()->json(['error' => 'Produto não encontrada'], 404);
        
        $produto->delete();

        return response()->json(['message'=>'Produto deletada com sucesso!'], 200);
    }

   
}

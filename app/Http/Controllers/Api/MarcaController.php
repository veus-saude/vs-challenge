<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Marca;

class MarcaController extends Controller
{
    private $marca;

    public function __construct(Marca $marca){
        $this->marca = $marca;
    }   
    
    public function index()
    {
        $marcas = $this->marca->get();
        return response()->json($marcas, 200);
    }

    public function show($id)
    {
        if( !$marca = $this->marca::find($id) )
            return response()->json(['error' => 'Marca não encontrada'], 404);
        
        return response()->json( $marca, 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|unique:marcas,nome'
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 422);
        }
        $marca = new $this->marca;
        $marca->nome = $request->nome;
        $marca->save();
        return response()->json(['message'=>'Marca criada com sucesso!', 'marca' => $marca], 201);

    }

    public function update(Request $request, $id)
    {
        
        if( !$marca = $this->marca::find($id) )
            return response()->json(['error' => 'Marca não encontrada'], 404);

        if(!$request->nome)
            return response()->json(['error' => 'Falta dados a serem informados para a alteração'], 422);

        $validator = Validator::make($request->all(), [
            'nome' => 'unique:marcas,nome'
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 422);
        }

        $marca->nome = $request->nome;
        $marca->save();
        return response()->json(['message'=>'Marca atualizada com sucesso!', 'marca' => $marca], 200);
    }

    public function destroy($id)
    {
        if( !$marca = $this->marca::find($id) )
            return response()->json(['error' => 'Marca não encontrada'], 404);
        
        $marca->delete();
        return response()->json(['message'=>'Marca deletada com sucesso!'], 200);
    }

}

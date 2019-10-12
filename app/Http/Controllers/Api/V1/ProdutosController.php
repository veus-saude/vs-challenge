<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Api\V1\Produtos;

class ProdutosController extends Controller
{

  public function list(Produtos $produtos){

    $all = $produtos->paginate(1);

    return $all;

  }

  public function search(Produtos $produtos, Request $request){


    $query = $produtos->where("nome", $request->input("nome"))
                      ->orwhere("marca", $request->input("marca"))
                      ->orderBy('nome', 'DESC')
                      ->paginate(1);

    return $query;

  }

  public function insert(Produtos $produtos, Request $request){

    $produtos->nome               = $request->input("nome");
    $produtos->marca              = $request->input("marca");
    $produtos->preco              = $request->input("preco");
    $produtos->quantidade_estoque = $request->input("quantidade_estoque");
    $produtos->save();

    return $produtos;

  }

  public function update(Produtos $produtos, Request $request){

     $update                     = $produtos->find($request->input("id"));
     $update->nome               = $request->input("nome");
     $update->marca              = $request->input("marca");
     $update->preco              = $request->input("preco");
     $update->quantidade_estoque = $request->input("quantidade_estoque");
     $update->save();

     return $update;

  }

  public function delete(Produtos $produtos, $id){

     $delete = $produtos->find($id);
     $delete->delete();

     return response()->json(['success'=>true]);

  }


}

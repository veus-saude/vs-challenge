<?php

namespace App\Http\Controllers\api;

use Mail;
use App\User;
use App\Produto;
use App\Estoque;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;
use Illuminate\Support\Facades\DB;

class BuscaController extends Controller {

  /**
  *  formulario de contato.
  *
  * @return index
  */
  static public function busca(Request $string, $version) {

    $produtos = [];
    $nome = null;
    $fornecedor = null;
    $lote = null;
    $fabricacao = null;
    $validade = null;
    $versao = null;
    $filtros = null;

    $versao = $version;

    $squery = $string->server()['QUERY_STRING'];

    // if (substr($filtros[0],0,1) == 'q') {
    //   $nome = explode('q=', $filtros[0]);
    // }

    //"q=atenolol&filter=brand:biosintetica&filter=lote:1913802"
    //msg: http://localhost:8000/api/v1/products?filter=lote%3A1913802&q=atenolol
    //nome, fornecedor, lote, fabricacao, validade

     if ($version == 'v1') {
        $filtros = explode('&filter=', $squery);
        if (substr($filtros[0],0,2) == 'q=') {
          $nome = substr($filtros[0],2);
        }
        foreach ($filtros as $filtro){
          $parametro = explode(':',$filtro);
          if ($parametro[0] == 'brand') {
            $fornecedor = $parametro[1];
          }
          if ($parametro[0] == 'lote') {
            $lote = $parametro[1];
          }
          if ($parametro[0] == 'fabricacao') {
            $fabricacao = $parametro[1];
          }
          if ($parametro[0] == 'validade') {
            $validade = $parametro[1];
          }
        }

        if ($nome != null and $fornecedor == null and $lote == null and $fabricacao == null and $validade == null) {
          $produtos = DB::table('estoque')
          ->join('produtos', 'produtos.id', '=', 'estoque.id_produto')
          ->join('fornecedor', 'fornecedor.id', '=', 'estoque.id_fornecedor')
          ->select('produtos.id', 'produtos.nome', 'fornecedor.nome as fornecedor', 'estoque.lote', 'estoque.fabricacao', 'estoque.validade', 'estoque.quantidade', 'estoque.valor as valor')
          ->where('produtos.nome', 'like', $nome . '%')
          ->paginate(15);
        }
        if ($nome != null and $fornecedor != null and $lote == null and $fabricacao == null and $validade == null) {
          $produtos = DB::table('estoque')
          ->join('produtos', 'produtos.id', '=', 'estoque.id_produto')
          ->join('fornecedor', 'fornecedor.id', '=', 'estoque.id_fornecedor')
          ->select('produtos.id', 'produtos.nome', 'fornecedor.nome as fornecedor', 'estoque.lote', 'estoque.fabricacao', 'estoque.validade', 'estoque.quantidade', 'estoque.valor as valor')
          ->where('produtos.nome', 'like', $nome . '%')
          ->where('fornecedor.nome', 'like', $fornecedor . '%')
          ->paginate(15);
        }
        if ($nome == null and $fornecedor != null and $lote == null and $fabricacao == null and $validade == null) {
          $produtos = DB::table('estoque')
          ->join('produtos', 'produtos.id', '=', 'estoque.id_produto')
          ->join('fornecedor', 'fornecedor.id', '=', 'estoque.id_fornecedor')
          ->select('produtos.id', 'produtos.nome', 'fornecedor.nome as fornecedor', 'estoque.lote', 'estoque.fabricacao', 'estoque.validade', 'estoque.quantidade', 'estoque.valor as valor')
          ->where('fornecedor.nome', 'like', $fornecedor . '%')
          ->paginate(15);
        }
        if ($nome != null and $fornecedor != null and $lote != null and $fabricacao == null and $validade == null) {
          $produtos = DB::table('estoque')
          ->join('produtos', 'produtos.id', '=', 'estoque.id_produto')
          ->join('fornecedor', 'fornecedor.id', '=', 'estoque.id_fornecedor')
          ->select('produtos.id', 'produtos.nome', 'fornecedor.nome as fornecedor', 'estoque.lote', 'estoque.fabricacao', 'estoque.validade', 'estoque.quantidade', 'estoque.valor as valor')
          ->where('produtos.nome', 'like', $nome . '%')
          ->where('fornecedor.nome', 'like', $fornecedor . '%')
          ->where('estoque.lote', $lote)
          ->paginate(15);
        }
        if ($nome == null and $fornecedor != null and $lote != null and $fabricacao == null and $validade == null) {
          $produtos = DB::table('estoque')
          ->join('produtos', 'produtos.id', '=', 'estoque.id_produto')
          ->join('fornecedor', 'fornecedor.id', '=', 'estoque.id_fornecedor')
          ->select('produtos.id', 'produtos.nome', 'fornecedor.nome as fornecedor', 'estoque.lote', 'estoque.fabricacao', 'estoque.validade', 'estoque.quantidade', 'estoque.valor as valor')
          ->where('fornecedor.nome', 'like', $fornecedor . '%')
          ->where('estoque.lote', $lote)
          ->paginate(15);
        }
        if ($nome == null and $fornecedor == null and $lote != null and $fabricacao == null and $validade == null) {
          $produtos = DB::table('estoque')
          ->join('produtos', 'produtos.id', '=', 'estoque.id_produto')
          ->join('fornecedor', 'fornecedor.id', '=', 'estoque.id_fornecedor')
          ->select('produtos.id', 'produtos.nome', 'fornecedor.nome as fornecedor', 'estoque.lote', 'estoque.fabricacao', 'estoque.validade', 'estoque.quantidade', 'estoque.valor as valor')
          ->where('estoque.lote', $lote)
          ->paginate(15);
        }
        if ($nome != null and $fornecedor != null and $lote != null and $fabricacao != null and $validade == null) {
          $produtos = DB::table('estoque')
          ->join('produtos', 'produtos.id', '=', 'estoque.id_produto')
          ->join('fornecedor', 'fornecedor.id', '=', 'estoque.id_fornecedor')
          ->select('produtos.id', 'produtos.nome', 'fornecedor.nome as fornecedor', 'estoque.lote', 'estoque.fabricacao', 'estoque.validade', 'estoque.quantidade', 'estoque.valor as valor')
          ->where('produtos.nome', 'like', $nome . '%')
          ->where('fornecedor.nome', 'like', $fornecedor . '%')
          ->where('estoque.lote', $lote)
          ->where('estoque.fabricacao', $fabricacao)
          ->paginate(15);
        }
        if ($nome != null and $fornecedor != null and $lote != null and $fabricacao != null and $validade != null) {
          $produtos = DB::table('estoque')
          ->join('produtos', 'produtos.id', '=', 'estoque.id_produto')
          ->join('fornecedor', 'fornecedor.id', '=', 'estoque.id_fornecedor')
          ->select('produtos.id', 'produtos.nome', 'fornecedor.nome as fornecedor', 'estoque.lote', 'estoque.fabricacao', 'estoque.validade', 'estoque.quantidade', 'estoque.valor as valor')
          ->where('produtos.nome', 'like', $nome . '%')
          ->where('fornecedor.nome', 'like', $fornecedor . '%')
          ->where('estoque.lote', $lote)
          ->where('estoque.fabricacao', $fabricacao)
          ->where('estoque.validade', $validade)
          ->paginate(15);
        }
        if ($nome == null and $fornecedor == null and $lote == null and $fabricacao != null and $validade == null) {
          $produtos = DB::table('estoque')
          ->join('produtos', 'produtos.id', '=', 'estoque.id_produto')
          ->join('fornecedor', 'fornecedor.id', '=', 'estoque.id_fornecedor')
          ->select('produtos.id', 'produtos.nome', 'fornecedor.nome as fornecedor', 'estoque.lote', 'estoque.fabricacao', 'estoque.validade', 'estoque.quantidade', 'estoque.valor as valor')
          ->where('estoque.fabricacao', $fabricacao)
          ->paginate(15);
        }
        if ($nome == null and $fornecedor == null and $lote == null and $fabricacao == null and $validade != null) {
          $produtos = DB::table('estoque')
          ->join('produtos', 'produtos.id', '=', 'estoque.id_produto')
          ->join('fornecedor', 'fornecedor.id', '=', 'estoque.id_fornecedor')
          ->select('produtos.id', 'produtos.nome', 'fornecedor.nome as fornecedor', 'estoque.lote', 'estoque.fabricacao', 'estoque.validade', 'estoque.quantidade', 'estoque.valor as valor')
          ->where('estoque.validade', $validade)
          ->paginate(15);
        }
        if ($nome == null and $fornecedor == null and $lote == null and $fabricacao != null and $validade != null) {
          $produtos = DB::table('estoque')
          ->join('produtos', 'produtos.id', '=', 'estoque.id_produto')
          ->join('fornecedor', 'fornecedor.id', '=', 'estoque.id_fornecedor')
          ->select('produtos.id', 'produtos.nome', 'fornecedor.nome as fornecedor', 'estoque.lote', 'estoque.fabricacao', 'estoque.validade', 'estoque.quantidade', 'estoque.valor as valor')
          ->where('estoque.fabricacao', $fabricacao)
          ->where('estoque.validade', $validade)
          ->paginate(15);
        }
        if ($nome == null and $fornecedor == null and $lote != null and $fabricacao != null and $validade != null) {
          $produtos = DB::table('estoque')
          ->join('produtos', 'produtos.id', '=', 'estoque.id_produto')
          ->join('fornecedor', 'fornecedor.id', '=', 'estoque.id_fornecedor')
          ->select('produtos.id', 'produtos.nome', 'fornecedor.nome as fornecedor', 'estoque.lote', 'estoque.fabricacao', 'estoque.validade', 'estoque.quantidade', 'estoque.valor as valor')
          ->where('estoque.lote', $lote)
          ->where('estoque.fabricacao', $fabricacao)
          ->where('estoque.validade', $validade)
          ->paginate(15);
        }
        if ($nome == null and $fornecedor != null and $lote != null and $fabricacao != null and $validade != null) {
          $produtos = DB::table('estoque')
          ->join('produtos', 'produtos.id', '=', 'estoque.id_produto')
          ->join('fornecedor', 'fornecedor.id', '=', 'estoque.id_fornecedor')
          ->select('produtos.id', 'produtos.nome', 'fornecedor.nome as fornecedor', 'estoque.lote', 'estoque.fabricacao', 'estoque.validade', 'estoque.quantidade', 'estoque.valor as valor')
          ->where('fornecedor.nome', 'like', $fornecedor . '%')
          ->where('estoque.lote', $lote)
          ->where('estoque.fabricacao', $fabricacao)
          ->where('estoque.validade', $validade)
          ->paginate(15);
        }

        // $filtered = true;
        //
        // return view('home')
        // ->with('produtos', $produtos)
        // ->with('filtered', $filtered);

        //return response()->json(['msg'=>$string->server()['QUERY_STRING'],'success'=>true, 'data'=>$produtos]);
        return response()->json(['success'=>true, 'data'=>$produtos]);
      } else {
        return response()->json(['msg'=>'Versão incorreta', 'success'=>false]);
      }
}
}

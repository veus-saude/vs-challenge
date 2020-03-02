<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ListaProdutosModel;

class ListaProdutoController extends Controller
{
    public  function index(Request $request) {
        $data = $request->all();
        $validacao = ListaProdutoController::ValidarParametro($data);
        if($validacao['validacao']){
            return ListaProdutoController::busca($validacao);
        }else{
            return $validacao;
        }
    }

    public static function ValidarParametro($data) {
        $parametros = array('nome', 'marca', 'preco', 'quantidade');//parametros podendo vir de uma tabela no banco        
        $code = 000;
        $validacao = true;
        $mensagem = "";
        foreach($data as $key => $value){           
           if($validacao){
                if(in_array($key , $parametros)){
                    $validacao = true;
                    $code = 200;
                    $mensagem = "sucesso";

                }else{
                    $validacao = false;
                    $code = 412;
                    $mensagem = "parametro " .  strtoupper($key) . " nao existe";
                         
                }
            }else{
                return array("code" => $code, "validacao" => $validacao, "mensagem" => $mensagem);
            }           
        }
        return array("code" => $code, "validacao" => $validacao, "mensagem" => $mensagem, "data" => $data);              
        
    }

    public static function busca($data){
        $filtro = new ListaProdutosModel();
        return $filtro->filtro($data);
    }
}

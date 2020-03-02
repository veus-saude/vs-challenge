<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ListaProdutosModel extends Model
{
    public function filtro($data){
        $parametros = $data['data'];    
        $path = storage_path("/mock/produtos.json") ;
        $json = file_get_contents($path); 
        $decode = json_decode($json);
        $resultado = array();
        $existe = true;
        $dadosTemporario = [];

       
        
        foreach($decode->data as $key1 => $value){ 

            foreach($value as $key2 => $row){     

                foreach($parametros as $chave => $row2){

                    if($key2 == $chave && $existe){

                        if($row == $row2){
                            $existe = true;                                                       
                        }else{
                            $existe = false;
                        }
                    }
                }                
            }

            if($existe){      
                foreach($value as $row){
                    array_push($dadosTemporario, $row);
                }                   
                array_push($resultado, $dadosTemporario);
            }      

            $existe = true; 
            $dadosTemporario = [];
        }

     
        return json_encode($resultado);           
    }
}

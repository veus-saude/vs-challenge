<?php

namespace App\Repository;

use Illuminate\Support\Facades\DB;

class ProdutosRepository
{
    public function buscar($name = "", $filter = [], $order = ""){
        $query = DB::table("produtos")
                ->select(['id','nome', 'quantidade', 'marca', 'preco']);

        if($name != ""){
            $query = $query->where("nome", "like", "%" . $name . "%");
        }

        if(count($filter) == 2){
            $query = $query->where($filter["column"], $filter["value"]);
        }

        if($order != "")
            $query->orderBy($order);

        return $query;
    }
}
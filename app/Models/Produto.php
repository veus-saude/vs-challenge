<?php

namespace App\Models;


use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produto extends Model
{
    use SoftDeletes;
 

    protected $fillable = [
        'nome',
        'marca',
        'preco',
        'quantidade'

    ];
    protected $casts = [
        'created_at' => 'date:d/m/Y H:i:s',
        'updated_at' => 'date:d/m/Y H:i:s'
    ];

    public function findProduto($id)
    {
        $produto = Produto::where([['id', $id]])->get();
        return $produto;
    }

    public function allProduto($produto)
    {
        //q=seringa&filter=brand:BUNZL
        $filter = explode(':', $produto["filter"]);
        $return = DB::table('produtos')->where([
            ['nome', '=', $produto["q"]],
            [$filter[0], '=', $filter[1]],
        ])->get();
        return $return;
    }


    public function insertProduto($produto)
    {
        $retorno = Produto::create($produto->all());
        return $retorno;
    }

    public function updateProduto($dados,$id)
    {
        $produto = Produto::find($id);
        $produto->update($dados->all());
        $retorno =  $produto->save();
        return $retorno;
    }
    public function deleteProduto($id)
    {
        $produto = Produto::where([['id', $id]])->delete();
        return $produto;
    }
}

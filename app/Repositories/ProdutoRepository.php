<?php


namespace App\Repositories;


use App\Produto;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ProdutoRepository  extends Repository
{

    public function __construct()
    {
        $this->setModel(Produto::class);
    }

    public static function condicoesDeBusca($request){
        $separa_condicoes = explode(';',$request->get('conditions'));


        foreach ($separa_condicoes as $separa_cond){
            $separa_key_valor = explode(':', $separa_cond);
            static::$model = self::where($separa_key_valor[0], 'like','%'.$separa_key_valor[1].'%');
        }

    }

    public static function selecionarCampos($request){

            $fields = $request->get('fields');
            static::$model = self::selectRaw($fields);

    }
}

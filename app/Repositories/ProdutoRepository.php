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

        $operadores = [
            'equal' => '=',
            'not_equal' => '<>',
            'less_than' => '<',
            'greater_than' => '>',
            'less_than_or_equal_to' => '<=',
            'greater_than_or_equal_to' => '>=',
            'in' => 'IN',
            'like' => 'LIKE'
        ];

        $separa_condicoes = explode(';',$request->get('filter'));


        foreach ($separa_condicoes as $separa_cond){
            $separa_key_valor = explode(':', $separa_cond);
            if(!empty($separa_key_valor[2])){

                if($operadores[$separa_key_valor[1]] == 'LIKE'){
                    static::$model = self::where($separa_key_valor[0], 'LIKE', '%'.$separa_key_valor[2].'%');
                }else if($operadores[$separa_key_valor[1]] == 'IN'){
                    static::$model = self::whereIn($separa_key_valor[0], explode(',',$separa_key_valor[2]));
                } else {
                    static::$model = self::where($separa_key_valor[0], $operadores[$separa_key_valor[1]], $separa_key_valor[2]);
                }
            }
        }

    }

    public static function selecionarCampos($request){

            $fields = $request->get('fields');
            static::$model = self::selectRaw($fields);

    }

    public static function ordenacao($request){

        $order = $request->get('order');
        $campos = explode('=', $order);
        $ordenarComo = explode(':', $campos[0]);


        static::$model = self::orderBy($ordenarComo[0],$ordenarComo[1]);

    }

}

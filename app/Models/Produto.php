<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produto extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'nome', 'brand', 'qtd_estoque', 'preco'
    ];

    protected $casts      = [
        'deleted_at' => 'date:d/m/Y H:i:s',
        'created_at' => 'date:d/m/Y H:i:s',
        'updated_at' => 'date:d/m/Y H:i:s'
    ];

    public function filtroProdutos($request)
    {
        $objProduto = $this;
        if ($request->has('fields')) {
            $fields = $request->query('fields');
            $objProduto = $objProduto->selectRaw($fields);
        }

        if ($request->has('q')) {
            $q = $request->query('q');
            $objProduto = $objProduto->where('nome', 'like', "%{$q}%");
        }

        if ($request->has('filter')) {
            $filter = $request->query('filter');
            $arrParams = explode(';', $filter);
            foreach ($arrParams as $key => $value) {
                $parametros = explode(':', $value);
                $objProduto = $objProduto->where($parametros[0], $parametros[1]);
            }
        }

        if ($request->has('sort')) {
            $sort = $request->query('sort');
            $arrParams = explode(';', $sort);
            foreach ($arrParams as $key => $value) {
                $parametros = explode(':', $value);
                $objProduto = $objProduto->orderBy($parametros[0], $parametros[1]);
            }
        }

        return $objProduto;
    }
       
}

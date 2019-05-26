<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Product extends Model
{
    protected $fillable = [
        'name', 'brand','price','qtd'
    ];

    public static function getSearchPaginatorOrderby(Request $request)
    {

        $filterName = $request->get('q');
        $filter = $request->get('filter');
        $filter = explode(':',$filter);

        $filterBrand = $filter[1];

        $where = [
            ['name', 'like',"%{$filterName}%"],
            ['brand', '=',$filterBrand]
        ];

        $query = self::where($where);

        $totalResults = count($query->get());

        $query = self::paginator($request, $query);
        $query = self::orderBy($request, $query);

        return [
            'list'=>$query->get(),
            'totalResults'=>$totalResults
        ];
    }
    private static function paginator($request, $query){
        if ($request->input('currentPage') && $request->input('pageSize')) {
            $query->offset($request->post('currentPage')*$request->post('pageSize'));
            $query->limit($request->post('pageSize'));
        }else{
            $query->offset(0); // se currentPage não receber nenhum valor o padrão será primeira página que é 0
            $query->limit(10); // se pageSize não receber nenhum valor o padrão é exibir 10 registros por página
        }
        return $query;
    }
    private static function orderBy($request, $query){
        if ($request->input('sortingFields') && $request->input('sortingDirections')) {
            $query->orderBy($request->post('sortingFields'), $request->post('sortingDirections'));
        }else{
            // se sortingFields não receber nenhum valor o padrão é ordenar pelo id
            $query->orderBy('id','DESC');
            // se sortingDirections não receber nenhum valor o padrão é desc
        }
        return $query;
    }
}

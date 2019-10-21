<?php
namespace App\Repositories;
use App\Products;
use Illuminate\Http\Request;
class ProductsRepository {

    
    public function findAll($params)
    {
        $produtos = Products::take($params['per_page']);
        if(!empty($params['filter']))
        {
            $produto = $produtos->where($params['filter'], $params['filter_value']);
        }

        if(!empty($params['sort']))
        {
            $produto = $produtos->orderBy($params['sort'], $params['sort_order']);
        }

        if(!empty($params['q']))
        {
            $produto = $produtos->where(function($query) use ($params) {
                $query->where('name', 'like', '%'.$params['q'].'%')
                     ->orWhere('brand', 'like', '%'.$params['q'].'%');
            });
        }

        return $produtos->paginate($params['per_page']);
    }

    public function find($id)
    {
        return Products::findOrFail($id);
    }

    public function store(Request $request)
    {
        Products::create($request->all());
    }
}
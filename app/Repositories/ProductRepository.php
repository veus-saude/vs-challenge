<?php

namespace App\Repositories;

use App\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface {

    public function get($data)
    {
        $productBrand = '';
        $sort = $data->has('sort') ? $data->sort : 'name,asc';
        $productName = $data->has('q') ? $data->q : '';
        $filterBrand = $data->has('filter') ? $data->filter : '';
        $orderBy = explode(',', $sort);
        
        if (!empty($filterBrand)) {
            $productBrand = explode(':', $filterBrand);
            $productBrand = $productBrand[1];
        }

        $products = Product::where('name', 'like', $productName.'%')
                           ->where('brand', 'like', $productBrand.'%')
                           ->orderBy($orderBy[0], $orderBy[1])
                           ->jsonPaginate();
        
        return $products;
    }

    public function getId($id)
    {
        return Product::findOrFail($id);
    }

    public function store($data)
    {
        $product = Product::create($data);

        return $product->id;
    }

    public function update($data, $id)
    {
        return Product::findOrFail($id)->update($data);
    }

    public function destroy($id)
    {
        return Product::findOrFail($id)->delete();
    }
}

<?php

namespace App\Repositories;

use App\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface {

    public function all()
    {
        return Product::all();
    }

    public function store($data)
    {
        return Product::create($data);
    }

    public function edit($id)
    {
        return Product::find($id);
    }

    public function update($data, $id)
    {
        return Product::find($id)->update($data);
    }

    public function destroy($id)
    {
        return Product::find($id)->delete();
    }
}

<?php

namespace App\Repositories\Contracts;

use App\Product;
use Illuminate\Pagination\LengthAwarePaginator;

interface ProductRepositoryInterface {

    public function getAll($request) : LengthAwarePaginator;

    public function getById($id):Product;

    public function create (array $attributes):Product;

    public function update (Product $product, array $attributes):Product;

    public function delete (Product $product) : bool;

    public function getFields() : Array;
    
}
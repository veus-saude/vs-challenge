<?php

namespace App\Repositories;

use App\Models\Products;
use Illuminate\Database\DatabaseManager;
use Illuminate\Http\Request;

class ProductsRepository {
    

    public function find($id){
        return Products::findOrFail($id);
    }

    public function store(Request $request){
        Products::create($request->all());
    }
}
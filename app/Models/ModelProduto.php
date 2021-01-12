<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelProduto extends Model
{
    protected $table='produtos';
    protected $fillable=['name', 'brand', 'price', 'quantity'];
}

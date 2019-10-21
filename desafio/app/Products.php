<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    public $timestamps = false; 
    
    protected $table = 'products';

    protected $fillable = [
        'name', 'brand', 'price', 'stock'
    ];
}

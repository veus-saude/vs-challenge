<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * Fillable fields
     */
    protected $fillable = ['name', 'brand', 'price', 'stock'];
}

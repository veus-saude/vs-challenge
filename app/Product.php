<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'brand', 'price', 'amount'];
    protected $hidden = ['created_at', 'updated_at'];
}

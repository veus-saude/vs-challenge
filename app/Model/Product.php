<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name','brand','price', 'amount'];
    protected $guarded = ['id', 'created_at', 'update_at'];
    protected $table = 'products';
}

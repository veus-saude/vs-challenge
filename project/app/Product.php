<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * {@inheritdoc}
     */
    protected $fillable = [
        'sku', 'name', 'brand', 'price', 'stock'
    ];
}

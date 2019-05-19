<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'brand_id', 'name', 'price', 'quantity_stock',
    ];
    
    public static $searchables = ['name'];
    public static $filters = ['brand' => 'name'];
    public static $sortables = ['price', 'quantity_stock'];

    public function brand()
    {
        return $this->belongsTo('App\Brand');
    }
}

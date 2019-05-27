<?php

namespace App\Http\Model\Product;

use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    protected $table = 'product';
    protected $primaryKey = 'product_id';
    protected $guarded = ['product_id'];

    public function brand()
    {
        return $this->hasOne('App\Http\Model\Brand\BrandModel','brand_id','brand_id');
    }
}

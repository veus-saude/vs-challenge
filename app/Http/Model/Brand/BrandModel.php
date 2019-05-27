<?php

namespace App\Http\Model\Brand;

use Illuminate\Database\Eloquent\Model;

class BrandModel extends Model
{
    protected $table = 'brand';
    protected $primaryKey = 'brand_id';
    protected $guarded = ['brand_id'];

    public function product()
    {
        return $this->belongsTo('App\Http\Model\Product\ProductModel','brand_id','brand_id');
    }
}

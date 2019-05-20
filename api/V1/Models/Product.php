<?php
namespace Api\V1\Models;

class Product extends Base
{
    protected $fillable = [
    	'brand_id',
        'name',
        'price',
        'quantity'
    ];

    protected $hidden = [];
    
    public function brand()
    {
    	return $this->belongsTo(Brand::class);
    }
}

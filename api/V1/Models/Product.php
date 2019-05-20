<?php
namespace Api\V1\Models;

class Product extends Base
{
    protected $hidden = [];
    
    public function brand()
    {
    	return $this->belongsTo(Brand::class);
    }
}

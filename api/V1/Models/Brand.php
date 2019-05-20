<?php
namespace Api\V1\Models;

class Brand extends Base
{
    protected $fillable = [
        'name'
    ];

    protected $hidden = [];
    
    public function products()
    {
    	return $this->hasMany(Product::class);
    }
}

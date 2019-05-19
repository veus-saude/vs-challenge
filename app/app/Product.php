<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'brand_id', 'price', 'quantity'
    ];

    private $filtersAvailable = [
        'name', 'brand', 'price', 'quantity'
    ];

    private $sortAvailable = [
        'name', 'price', 'quantity'
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function getFiltersAvailable() {
		return $this->filtersAvailable;
    }
    
    public function getSortAvailable() {
		return $this->sortAvailable;
    }
    
}

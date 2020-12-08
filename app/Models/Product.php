<?php

namespace App\Models;

use App\Models\FilterModel;
use Illuminate\Database\Eloquent\Model;

class Product extends FilterModel
{
    protected $fillable = [
        'name', 'brand_id', 'price', 'amount'
    ];
    protected $hidden = ['created_at', 'updated_at'];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}

<?php

namespace App;

use App\Brand;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';

    protected $guarded = [];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

}

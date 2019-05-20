<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'value',
        'quantity',
        'brand_id'
    ];

    public function brand()
    {
        return $this->hasOne(Brand::class);
    }
}

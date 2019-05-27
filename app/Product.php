<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'brand', 'price', 'quantity'
    ];

    public static $rules = [
        'name' => 'required',
        'brand' => 'required'
    ];
}

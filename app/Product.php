<?php

namespace App;

//use App\Traits\ApiQueryBuilder;
use App\Traits\ApiQueryBuilder;
//use App\Traits\ExampleCode;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use ApiQueryBuilder;

    protected $fillable = [
        'name', 'brand', 'price', 'quantity',
    ];

}

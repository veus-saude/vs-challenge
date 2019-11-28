<?php

namespace App\Models\Api\v1;

use Illuminate\Database\Eloquent\Model;
use App\Traits\QueryAuxTrait;

class Brand extends Model
{
    use QueryAuxTrait;
    
    public $table = 'brands';
    public $per_page = 20;
    
    protected $fillable = [
        'name'
    ];


    public function products()
    {
        return $this->hasMany('App\Models\Api\v1\Product', 'id', 'brand_id')->get();
    }
}

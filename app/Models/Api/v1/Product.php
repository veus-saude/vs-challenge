<?php

namespace App\Models\Api\v1;

use Illuminate\Database\Eloquent\Model;
use App\Traits\QueryAuxTrait;

class Product extends Model
{
    use QueryAuxTrait;
    
    public $table = 'products';
    public $per_page = 20;
    
    protected $fillable = [
        'name',
        'brand_id'
    ];
    
    public function brand()
    {
        return $this->belongsTo('App\Models\Api\v1\Brand', 'brand_id', 'id')->first();
    }
}

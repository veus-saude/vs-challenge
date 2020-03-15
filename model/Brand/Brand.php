<?php
namespace Model\Brand;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = 'brand';
    protected $primaryKey = 'brand_id';
    public $timestamps = false;
    protected $guarded = ['brand_id'];

    public function scopeFields($query)
    {
        return $query->select(
            'brand.brand_id',
            'brand.name'
        );
    }

}

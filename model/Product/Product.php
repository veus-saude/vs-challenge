<?php
namespace Model\Product;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';
    protected $primaryKey = 'product_id';
    public $timestamps = false;
    protected $guarded = ['product_id'];

    public function brand()
    {
        return $this->hasOne('Model\Brand\Brand','brand_id','brand_id');
    }

    public function scopeFields($query)
    {
        return $query->select(
            'product.product_id',
            'product.name',
            'product.price',
            'product.quantity',
            'product.brand_id'
        );
    }
}

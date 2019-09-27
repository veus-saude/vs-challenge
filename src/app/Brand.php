<?php

namespace App;

use App\Product;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = 'brand';

    public $timestamps = false;

    protected $guarded = [];

    /**
     * Brand has many Products.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }

}

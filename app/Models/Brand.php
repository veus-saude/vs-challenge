<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = [
        'name',
    ];
    protected $hidden = ['created_at', 'updated_at'];
    
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}

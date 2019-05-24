<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	protected $hidden = ['created_at','updated_at'];
	
    public function brand(){
    	return $this->belongsTo(\App\Models\Brand::class);
    }
}

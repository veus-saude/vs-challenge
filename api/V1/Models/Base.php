<?php
namespace Api\V1\Models;

use Illuminate\Database\Eloquent\Model;

class Base extends Model
{
	public function scopeSearch($query, $term = null, $column = 'name')
    {
    	if($term) return $query->where($column, 'LIKE', '%' . $term . '%');
    }
    
    public function scopeSort($query, $sort = null, $order = 'asc')
    {
    	if($sort) return $query->orderBy($sort, $order);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'brand', 'price', 'amount'
    ];

    public function scopeSearchString($query, $inputs){
        if( !isset($inputs['q']) )
            return $query;

        return $query->where(function($query) use ($inputs) {
				$query->orWhere('name', 'like', '%'.$inputs['q'].'%')
              		  ->orWhere('brand', 'like', '%'.$inputs['q'].'%')
                      ->orWhere('price', 'like', '%'.$inputs['q'].'%')
                      ->orWhere('amount', 'like', '%'.$inputs['q'].'%');
        });
    }

    public function scopeFilterField($query, $inputs){
        if(!isset($inputs['filter']))
            return $query;

        $filter = explode(':', $inputs['filter']);
        return $query->where($filter[0], $filter[1]);
    }

    public function scopeSortField($query, $inputs){
        if(!isset($inputs['sort']))
            return $query;

        return $query->orderBy($inputs['sort']);
    }

}
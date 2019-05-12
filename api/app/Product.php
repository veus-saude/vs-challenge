<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'brand', 'price', 'amount'
    ];

    public function scopeSearchString($query, $inputs){
        if(!isset($inputs['q']))
            return $query;

        return $query->where(function($query) use ($inputs) {
            $query->orWhere('name', 'LIKE', '%' . $inputs['q'] . '%')
                ->orWhere('brand', 'LIKE', '%' . $inputs['q'] . '%')
                ->orWhere('price', 'LIKE', '%' . $inputs['q'] . '%')
                ->orWhere('amount', 'LIKE', '%' . $inputs['q'] . '%');
        });
    }

    public function scopeFieldFilter($query, $inputs){

        if(!isset($inputs['filter']))
            return $query;

        $filter = explode(':', $inputs['filter']);
        return $query->where($filter[0], $filter[1]);
    }

    public function scopeSortFilter($query, $inputs){

        if(!isset($inputs['sort']))
            return $query;

        return $query->orderBy($inputs['sort']);
    }
}

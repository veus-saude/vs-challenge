<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    public $filters = [];
    public $sorts = [];

    protected $fillable = [
        'name', 'brand', 'price', 'quantity',
    ];

    public function getProducts()
    {

        $query = $this::query();

        if($this->name){
            $query->where('name', 'like', '%' . $this->name . '%');
        }

        foreach ($this->filters as $field => $value) {
            if(in_array($field, $this->getFillable())){
                $query->where($field , $value);
            }
        }

        foreach ($this->sorts as $field => $value) {
            $direction = in_array($value, ['ASC', "DESC"]) ? $value : "ASC";
            if(in_array($field, $this->getFillable())){
                $query->orderBy($field, $direction);
            }
        }

        return $query->paginate(10);
    }
}

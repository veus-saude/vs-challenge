<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $filters = [];
    public $sortBy;
    public $perPage;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'brand', 'price', 'quantity',
    ];

    public function getProducts()
    {
        $query = $this::query();

        if ($this->name) {
            $query->where('name', 'like', '%' . $this->name . '%');
        }

        foreach ($this->filters as $field => $value) {

            if (in_array($field, $this->getFillable())) {
                $query->where($field, $value);
            };
        }

        if ($this->sortBy) {
            $query->orderBy($this->sortBy, 'ASC');
        }

        return $query->paginate($this->perPage ?? 10);
    }
}

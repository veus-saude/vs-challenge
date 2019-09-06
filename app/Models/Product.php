<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'brand',
        'price',
        'quantity'
    ];

    public function setPriceAttribute($value)
    {
        $this->attributes['price'] = str_replace(",", ".", str_replace (".","", $value));
    }

    public function getPriceAttribute($value)
    {
        return number_format($value, 2, ',', '.');
    }

    /**
     * Pick up all products or searchable
     *
     * @param array $attributes
     * @return void
     */
    public static function search(array $attributes = [])
    {
        $limitPerPage = 15;
        $limitPerPage = $attributes['limit'] ?? $limitPerPage;
        $query = parent::whereNotNull('name');
        if (isset($attributes['q'])) {
            $keyword = $attributes['q'];
            $query->where('name', 'like', "%{$keyword}%");
        } if (isset($attributes['filter'])) {
            $filters = explode(':', $attributes['filter']);
            list($column, $value) = $filters;
            $query->where([$column => $value]);
        } if (isset($attributes['sort'])) {
            $sort = explode(':', $attributes['sort']);
            list($column, $value) = $sort;
            $query->orderBy($column, $value);
        }

        return $query->paginate($limitPerPage);
    }
}

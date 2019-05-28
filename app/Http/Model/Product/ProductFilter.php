<?php
namespace Model\Eloquent\Telium\Event;

use App\Support\QueryFilters;

class ProductFilter extends QueryFilters
{

    public function productId($value)
    {
        return $this->builder->where('product_id', '=', $value);
    }

}

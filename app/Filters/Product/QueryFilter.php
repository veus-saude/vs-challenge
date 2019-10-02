<?php

namespace App\Filters\Product;

use Fouladgar\EloquentBuilder\Support\Foundation\Contracts\Filter;
use Illuminate\Database\Eloquent\Builder;

class QueryFilter extends Filter
{
    /**
     * Apply the age condition to the query.
     *
     * @param Builder $builder
     * @param mixed   $value
     *
     * @return Builder
     */
    public function apply(Builder $builder, $value): Builder
    {
        return $builder->where('description', 'like', "%{$value}%");
    }
}
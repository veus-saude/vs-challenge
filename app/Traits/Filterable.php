<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use App\Support\QueryFilters;

trait Filterable
{
    /**
     * Filter a result set.
     *
     * @param  Builder      $query
     * @param  QueryFilters $filters
     * @return Builder
     */
    public function scopeFilter($query, QueryFilters $filters)
    {
        return $filters->apply($query);
    }
}
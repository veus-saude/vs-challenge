<?php

namespace App\Filters;

use App\User;
use Illuminate\Http\Request;

class ProductFilters extends QueryFilters
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
        
        parent::__construct($request);
    }
  
    public function name($term) {
        return $this->builder->where('name', 'LIKE', "%$term%");
    }
  
    public function brand($term) {
        return $this->builder->where('brand', 'LIKE', "%$term%");
    }

    public function fromPrice($term) {
        return $this->builder->where('price', '>=', $term);
    }

    public function toPrice($term) {
        return $this->builder->where('price', '<=', $term);
    }

    public function fromStock($term) {
        return $this->builder->where('stock', '>=', $term);
    }

    public function toStock($term) {
        return $this->builder->where('stock', '<=', $term);
    }

    public function sort($term) {
        $term = explode(':', $term);

        return $this->builder->orderBy($term[0], $term[1] ?? 'asc');
    }
}
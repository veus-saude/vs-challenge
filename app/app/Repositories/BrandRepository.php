<?php

namespace App\Repositories;

use App\Brand;
use App\Repositories\Contracts\BrandRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use phpDocumentor\Reflection\Types\Boolean;

class BrandRepository implements BrandRepositoryInterface
{
    
    protected $model;

    public function __construct(Brand $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
       
        $result = $this->model::orderBy('name')->get();
       
        return $result;
    }

}
<?php

namespace App\Repositories\Contracts;

use App\Brand;
use Illuminate\Pagination\LengthAwarePaginator;

interface BrandRepositoryInterface {

    public function getAll();
    
}
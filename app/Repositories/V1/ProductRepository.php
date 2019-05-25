<?php

namespace App\Repositories\V1;

use App\Models\Product;
use App\Repositories\EloquentRepository;
use App\Repositories\ProductRepositoryContract;

class ProductRepository extends EloquentRepository implements ProductRepositoryContract
{
    protected function getModel(): string
    {
        return Product::class;
    }

    public function all($query, $filters, $sort = null, $page = null)
    {
        $productQuery = Product::query();

        if ($query) {
            $productQuery = $productQuery->where('name', 'like', "%{$query}%");
        }
        if ($filters) {
            $productQuery = $this->addFilterToQuery($productQuery, $filters);
        }
        if ($sort) {
            $productQuery = $this->addSortingToQuery($productQuery, $sort);
        }
        if ($page) {
            return $productQuery->paginate(25, ['*'], 'page', $page);
        }

        return $productQuery->get();
    }

    private function validateSortAndFilterFields($field)
    {
        if (!in_array($field, [
            "brand", "price", "quantity",
        ])) throw new \Exception("Bad Filter/Sort input", 422);
    }

    private function addFilterToQuery($query, $filters)
    {
        $filtersArray = explode(":", $filters);

        $this->validateSortAndFilterFields($filtersArray[0]);

        return $query->where($filtersArray[0], $filtersArray[1]);
    }

    private function addSortingToQuery($query, $sorting)
    {
        $this->validateSortAndFilterFields($sorting);

        return $query->orderBy($sorting);
    }


}
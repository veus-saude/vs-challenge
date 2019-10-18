<?php

namespace App\Repositories;

use Illuminate\Support\Arr;
use App\Product;

/**
 * Product Repository
 */
class ProductRepository {

    function __construct() {
    }

    /**
     * List of products
     *
     */
    public function list($params) {

        # Filters and Search Query
        $where = [];

        if (Arr::has($params, 'q') && !empty($params['q'])) {
            $where[] = ['name', 'like', "%{$params['q']}%"];
        }

        $validFilterFields = ['brand', 'price', 'stock'];

        if (
            Arr::has($params, 'filter.field') && !empty($params['filter']['field']) && in_array($params['filter']['field'], $validFilterFields) &&
            Arr::has($params, 'filter.value') && !empty($params['filter']['value'])
        ) {
            $where[] = [$params['filter']['field'], '=', $params['filter']['value']];
        }

        # Pagination
        $page = Arr::get($params, 'page', 1);
        $perPage = Arr::get($params, 'perPage', 2);

        $start = ($page - 1) * $perPage;

        $result = Product::where($where)
                    ->limit($perPage)
                    ->offset($start)
                    ->get();

        return $result;
    }
}

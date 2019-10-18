<?php

namespace App\Repositories;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;
use App\Product;

/**
 * Product Repository
 */
class ProductRepository {

    function __construct() {
    }

    /**
     * Deletes a product by id
     *
     * @param int $id
     * @return bool
     */
    public function delete($id) {
        $product = Product::find($id);
        return $product->delete();
    }

    /**
     * Find a product by id
     *
     * @param int $id
     * @return Product
     */
    public function find($id) {
        return Product::find($id);
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
        $page    = Arr::get($params, 'page', 1);
        $perPage = Arr::get($params, 'perPage', 2);
        $start   = ($page - 1) * $perPage;


        $qry = Product::where($where)
                    ->limit($perPage)
                    ->offset($start);

        # Sorting
        $sortableFields = ['name', 'brand', 'price', 'stock', 'created_at', 'updated_at'];

        if (
            Arr::has($params, 'sort.field') && !empty($params['sort']['field']) && in_array($params['sort']['field'], $sortableFields) &&
            Arr::has($params, 'sort.order') && !empty($params['sort']['order'])
        ) {
            $qry->orderBy($params['sort']['field'], $params['sort']['order']);
        }


        $result = $qry->get();

        return $result;
    }

    /**
     * Saves a product
     *
     * @return Product
     */
    public function save($product) {

        $validator = Validator::make(
            $product,
            [
                'name' => 'required|string|max:255',
                'stock' => 'required|numeric',
                'price' => 'required|numeric',
                'brand' => 'required|string|max:60',
            ]
        );
        // If there are validation errors
        if ($validator->fails()) {
            throw new \Exception($validator->errors()->all()[0]);
        }

        $p = new Product($product);
        return $p->save();
    }

    /**
     * Updates a product
     *
     * @return bool
     */
    public function update($product) {
        $validator = Validator::make(
            $product,
            [
                'id' => 'required|numeric',
                'name' => 'required|string|max:255',
                'stock' => 'required|numeric',
                'price' => 'required|numeric',
                'brand' => 'required|string|max:60',
            ]
        );
        // If there are validation errors
        if ($validator->fails()) {
            throw new \Exception($validator->errors()->all()[0]);
        }

        $p = Product::find($product['id']);
        // Fill in the fields
        $p->fill(Arr::except($product, ['id']));
        return $p->save();
    }
}

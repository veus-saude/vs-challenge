<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\API\BaseController;
use App\Product;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ProductController.
 *
 * @package App\Http\Controllers\API\v1
 */
class ProductController extends BaseController
{
    /**
     * Filter resource method.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Database\Eloquent\Builder $builder
     *
     * @throws Exception
     */
    protected function filter(Request $request, Builder $builder) : void
    {
        if ($rawFilter = $request->input('filter')) {
            $fields = array_map(function ($rawField) {
                list($field, $value) = array_pad(explode(':', $rawField), 2, null);
                return [
                    'field' => $field,
                    'value' => $value,
                ];
            }, explode(',', $rawFilter));

            foreach ($fields as $filter) {
                if (Schema::hasColumn('products', $filter['field']) == false) {
                    throw new Exception("Field '${filter['field']}' doesn't exists.");
                }

                $builder->where($filter['field'], '=', $filter['value']);
            }
        }
    }

    /**
     * Sort resource method.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Database\Eloquent\Builder $builder
     *
     * @throws Exception
     */
    protected function sort(Request $request, Builder $builder) : void
    {
        if ($rawSort = $request->input('sort')) {
        $fields = array_map(function ($rawField) {
            list($field, $value) = array_pad(explode(':', $rawField), 2, null);
            return [
                'field' => $field,
                'direction' => $value ?? 'ASC',
            ];
        }, explode(',', $rawSort));

        foreach ($fields as $filter) {
            if (Schema::hasColumn('products', $filter['field']) == false) {
                throw new Exception("Field '${filter['field']}' doesn't exists.");
            }

            $builder->orderBy($filter['field'], $filter['direction']);
        }
    }

    }

    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(Request $request) : Response
    {
        $products = Product::query();

        if ($q = $request->input('q')) {
            $products->where('name', 'LIKE', "%$q%");
        }

        try {
            $this->filter($request, $products);
        } catch (\Exception $e) {
            return $this->sendError("Invalid filter.", $e->getMessage());
        }

        try {
            $this->sort($request, $products);
        } catch (\Exception $e) {
            return $this->sendError("Invalid sort.", $e->getMessage());
        }

        return response()->json($products->paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function store(Request $request) : Response
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'sku' => 'required|unique:products',
            'name' => 'required',
            'brand' => 'required',
            'price' => 'required',
            'stock' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $product = Product::create($input);

        return $this->sendResponse($product->toArray(), 'Product created successfully.', Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function show($id) : Response
    {
        $product = Product::find($id);

        if (is_null($product)) {
            return $this->sendError('Product not found.');
        }

        return $this->sendResponse($product->toArray(), 'Product retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Product $product
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function update(Request $request, $id) : Response
    {
        $product = Product::find($id);

        if (is_null($product)) {
            return $this->sendError('Product not found.');
        }

        $input = $request->all();

        $validator = Validator::make($input, [
            'sku' => 'unique:products',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $product->update($input);

        return $this->sendResponse($product->toArray(), 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Product $product
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function destroy($id) : Response
    {
        $product = Product::find($id);

        if (is_null($product)) {
            return $this->sendError('Product not found.');
        }

        $product->delete();

        return $this->sendResponse($product->toArray(), 'Product deleted successfully.');
    }
}

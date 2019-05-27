<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Product as ProductModel;
use App\Http\Controllers\Controller as Controller;

class ProductController extends Controller
{   
    /**
     * @var ProductModel
     */
    private $product;

    /**
     * Construct of class
     */
    public function __construct()
    {
        $this->product = new ProductModel();
    }

    /**
     * Store new product.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, $this->product::$rules);
        $product = $this->product->create($request->all());

        return response()->json($product, 201);
    }

    /**
     * Display list of filtered products
     *
     * @param  int  $id
     * @return Response
     */
    public function show(Request $request)
    {
        $products = $this->buildQuery($request);
        
        return response()->json($products);
    }

    /**
     * Update product.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function update($id, Request $request)
    {
        var_dump($request->all());die;
        $this->validate($request, $this->product::$rules);
        $product = $this->product->findOrFail($id);
        $product->update($request->all());

        return response()->json($author, 200);
    }

    /**
     * Delete product.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $product = $this->product->findOrFail($id)->delete();

        return response('Deleted Successfully', 200);
    }

    /**
     * Build search query.
     *
     * @param  int  $id
     * @return Response
     */
    public function buildQuery(Request $request)
    {
        $name   = $request->get('q');
        
        $filter = $request->get('filter') ? explode(':', $request->get('filter')) : '';
        $page   = $request->get('page') ? $request->get('page') : null;
        $l      = $request->get('l') ? $request->get('l') : 100;
        $sort   = $request->get('sort') ? explode(':', $request->get('sort')) : null;

        $query = $this->product::query();

        if ($name) {
            $query->where('name', 'like', "%$name%");
        }

        $fields = ['id', 'brand', 'price', 'quantity', 'created_at'];
        $validateFilter = $filter && count($filter) == 2 && in_array($filter[0], $fields);

        if ($validateFilter) {
            $query->where($filter[0], 'like', "%{$filter[1]}%");
        }

        $fields[] = 'name';
        $sortedBy = ['desc', 'asc'];
        $validateSort = $sort && count($sort) == 2 && in_array($sort[0], $fields) && in_array($sort[1], $sortedBy);

        if ($validateSort) {
            $query->orderBy($sort[0], $sort[1]);
        }

        return $query->paginate($l, ['*'], 'page', $page);
    }

}

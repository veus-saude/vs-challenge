<?php


namespace App\Http\Controllers;

use League\Fractal;
use League\Fractal\Manager;
use League\Fractal\Resource\Item;
use League\Fractal\Resource\Collection;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use App\Product;
use App\Transformers\ProductTransformer;

class ProductsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->fractal = new Manager();
    }

    //
    public function list()
    {
        $paginator = Product::paginate();
        $products = $paginator->getCollection();
        $resource = new Collection($products, new ProductTransformer);
        $resource->setPaginator(new IlluminatePaginatorAdapter($paginator));
        return $this->fractal->createData($resource)->toArray();
    }

    //
    public function detail($id)
    {
        $product = Product::find($id);
        $resource = new Item($product, new ProductTransformer);
        return $this->fractal->createData($resource)->toArray();
    }

    //
    public function create(Request $request)
    { }

    //
    public function update($id, Request $request)
    { }

    //
    public function delete($id)
    { }
}

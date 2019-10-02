<?php


namespace App\Http\Controllers;

use League\Fractal;
use League\Fractal\Manager;
use League\Fractal\Resource\Item;
use League\Fractal\Resource\Collection;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;

use Illuminate\Http\Request;

use App\Product;
use App\Transformers\ProductTransformer;
use EloquentBuilder;

class ProductsController extends Controller
{

    private $fractal;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    { 
        $this->middleware('auth', [
            'only' =>   [
                'create',
                'update',
                'delete'
            ]
        ]);
        $this->fractal = new Manager();
    }

    //
    public function list(Request $request)
    {
        
        $paginator = EloquentBuilder::to(Product::class, $request->all())->paginate();
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
    {
        $this->validate($request, [
            'name' => 'bail|required|max:255',
            'description' => 'bail|required',
            'sku' => 'bail|required',
            'brand' => 'bail|required'
        ]);

        $product = Product::create($request->all());
        $resource = new Item($product, new ProductTransformer);
        return $this->fractal->createData($resource)->toArray();
    }

    //
    public function update($id, Request $request)
    {
        $this->validate($request, [
            'name' => 'bail|required|max:255',
        ]);

        if (!Product::find($id)) {
            return $this->customResponse('product not found!', 404);
        }

        $product = Product::find($id)->update($request->all());

        if ($product) {
            $resource = new Item(Product::find($id), new ProductTransformer);
            return $this->fractal->createData($resource)->toArray();
        }
        return $this->customResponse('Failed to update product!', 400);
    }

    //
    public function delete($id)
    {
        if (!Product::find($id)) {
            return $this->customResponse('Not found!', 404);
        }

        if (Product::find($id)->delete()) {
            return $this->customResponse('Product deleted ok!', 410);
        }

        return $this->customResponse('Failed to delete product!', 400);
    }
}

<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = DB::table("products");
        
        if (!empty($request->q) && !empty($request->filter)) {
            
            $product = ["name", "like", "%{$request->q}%"];
            
            $params = explode(':', $request->filter);
            $filter = $this->filter($params);
           
            $products->where([$product, $filter]);

        } else if (!empty($request->q)) {
            
            $products->where("name", "like", "%{$request->q}%");
        }
        
        /**
         * 
         * Sorting
         * 
         * Example: http://localhost/vs-challenge/public/api/v1/products?sort_by=name:asc
         * 
         */
        if (!empty($request->sort_by)) {
            
            $filter = explode(':', $request->sort_by);
            
            $products->orderBy($filter[0], $filter[1]);
        }
        
        /**
         * 
         * Pagination
         * 
         * Example: http://localhost/vs-challenge/public/api/v1/products?paginate=true
         * 
         * Or
         * 
         * Example: http://localhost/vs-challenge/public/api/v1/products?paginate=true&per_page=5
         */
        if ($request->paginate == "true") {
            $perPage = ($request->per_page ? $request->per_page : 10);
        }
        
        if (!$products->count()) {
            return response()->json(['error' => 'There is no product for this filter'], 400);
        }
        
        return response()->json([
            'products' => ($request->paginate == "true" ? $products->paginate($perPage) : $products->get())
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), $this->rules());
        
        if ($validate->fails()) {
            return response()->json(['error' => $validate->errors()], 400);
        }
        
        $product = Product::create($request->all());
        
        return response()->json(['product' => $product], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        
        if (!$product) {
            return response()->json(['error' => 'The product does not exist'], 400);
        }
        
        return response()->json(['product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {    
        $product = Product::find($id);
        
        if (!$product) {
            return response()->json(['error' => 'The product does not exist'], 400);
        }
        
        $validate = Validator::make($request->all(), $this->rules());
        
        if ($validate->fails()) {
            return response()->json(['error' => $validate->errors()], 400);
        }
        
        $product->update($request->all());
        
        return response()->json(['product' => $product], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        
        if (!$product) {
            return response()->json(['error' => 'The product does not exist'], 400);
        }
        
        $product->destroy($product->id);
        
        return response()->json(['success' => 'Product successfully deleted!'], 200);
    }
    
    /**
     * Validation rules
     * @return array
     */
    private function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'price' => 'required|numeric',
            'quantity' => 'required|integer'
        ];
    }
    
    /**
     * Validation filters
     * @param array $params
     * @return array
     */
    private function filter(array $params): array
    {
        $filter = [];
        
        if (count($params) > 2) {
            $filter = [$params[0], $params[1], $params[2]];
        } else {
            $filter = [$params[0], "like", "%{$params[1]}%"];
        }
        
        return $filter;
    }
}

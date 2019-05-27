<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter = $request->query->get('filter');
        $sort = $request->query->get('sort');
        $query = $request->query->get('q');

        $products = new Product;

        if($query){
            $products = $products->where('name','LIKE',"%{$query}%");
        }

        if(strlen($sort)){
            @list($column, $order) = explode(':',$sort);
            $order = $order ?: 'ASC';

            if($this->isColumn($column)){
                $products = $products->orderBy($column, $order);
             } else {
                list($relation, $column) = explode('.',$column);

                $products = $products->select('products.*', \DB::raw(
                    '(SELECT ' . $column . ' from ' . \Str::plural($relation) . ' WHERE products.' . $relation . '_id = ' . \Str::plural($relation) . '.id) as ' . $relation .'_'. $column 
                ))->orderBy($relation .'_'. $column);
            }
        }

        if(strlen(trim($filter))){
            $filter_arr = explode('|',$filter);
            
            foreach ($filter_arr as $k => $f) {
                $operator = '=';

                list($key, $value) = explode(':',$f);
                
                // TESTAMOS SE O OPERADOR É menor, maior, igual OU variantes
                preg_match('/^[<>=]{1,2}/', $value, $m);
                if($m){
                    $value = str_replace($m[0], '', $value);
                    $operator = $m[0];
                }

                if($this->isColumn($key)) {
                    preg_match('/[,]/', $value, $n);
                    if($n){
                        $values = explode(',',$value);
                        $values[0] .= $values[0] > 0 ? "00" : '';
                        $values[1] .= "00";
                        $products = $products->whereBetween($key, $values);
                    } else {
                        $products = $products->where($key, $operator, $value);
                    }

                } else {
                    if($key == 'brand'){
                        $column = 'name';
                    }
                    $products = $products->whereHas($key, function($query) use ($column, $operator, $value) {
                        
                        $value = ($operator != '=' ? '':'%') . $value . ($operator != '=' ? '':'%');

                        $query->where($column, $operator != '=' ? $operator : 'LIKE', $value);
                    });
                }
                
            }
        }

        // dd($products->toSql(), $products->getBindings());

        $products = $products->with('brand')->paginate(5);

        return response()->json($products);
    }

    private function isColumn($key){
        return \Schema::hasColumn((new Product)->getTable(), $key);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}

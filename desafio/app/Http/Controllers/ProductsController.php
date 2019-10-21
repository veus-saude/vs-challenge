<?php

namespace App\Http\Controllers;

use App\Services\ProductsService;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private const PER_PAGE = 2;

    private $allowedFilters = [
        'brand',
        'price',
    ];

    /**
     * @var ProductsService
     */
    protected $productsService;

    public function __construct( ProductsService $productsService )
    {
        $this->productsService = $productsService;
    }

    public function index(Request $request)
    {
        $params['per_page'] = $this::PER_PAGE;
        $params['filters'] = $request->query('filter');
        
        if($request->has('q'))
        {
            $params['q'] = $request->q;
        }

        if($request->has('sort'))
        {
            $params['sort'] = $request->sort;
        }

        if($request->has('page'))
        {
            $params['page'] = $request->page;
        }
        

        $filters = $params['filters'];

        foreach( $this->allowedFilters as $filter)
        {
            if(isset($filters[$filter]))
            {
                $params['filter'] = $filter;
                $params['filter_value'] = $filters[$filter];
            }
        }

        if(isset($params['sort']['field']))
        {
            $params['sort_order'] = isset($params['sort']['order']) ? $params['sort']['order'] : 'asc';
            $params['sort'] = $params['sort']['field'];
        }

        $response = $this->productsService->findAll($params);

        return $response;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return response($this->productsService->store($request), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $produto = $this->find($id);
        $produto->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $produto = $this->find($id);
        $produto->delete();
    }

    /**
     * Return the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    private function find($id)
    {
        return $this->productsService->find($id);
    }
}

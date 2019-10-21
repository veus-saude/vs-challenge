<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;
use Illuminate\Database\DatabaseManager;
use App\Services\ProductsService;
use Illuminate\Support\Facades\Route;

class ProductsController extends Controller
{
    /**
     * @var ProductsService
     */
    protected $productsService;

    private $filters = [
        'marca',
        'preco',
        'quantidade'
    ];
    private $params = [];

    public function __construct(
        ProductsService $productsService
    ){
        $this->productsService = $productsService;
    }
    public function index(Request $request)
    {
        $products = new Products();
        
        $params['filters'] = $request->query('filter');

        if($request->has('sort')){
            $params['sort'] = $request->sort;
        }

        if($request->has('q')){
            $params['q'] = $request->q;
        }
        $params['per_page'] = $request->has('per_page') ? $request->per_page : 3;
        
        $response = $this->productsService->findAll($params);
        
        return $response;
    }

    public function store(Request $request)
    {
        return response($this->productsService->store($request), 201);
    }

    public function show($id)
    {
        return $this->find($id);
    }

    public function update(Request $request, $id)
    {
        $produto = $this->find($id);
        $produto->update($request->all());
    }

    public function destroy($id)
    {
        $produto = $this->find($id);
        $produto->delete();
    }

    private function find($id)
    {
        return $this->productsService->find($id);
    }
}

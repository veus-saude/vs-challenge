<?php

namespace App\Services;

use Illuminate\Database\DatabaseManager;
use App\Repositories\ProductsRepository;
use App\Models\Products;
use Illuminate\Http\Request;

class ProductsService {

    /**
     * @var ProductsRepository
     */
    protected $productsRepository;

    private $allowedFilters = [
        'marca',
        'preco',
        'quantidade'
    ];

    public function __construct(
        DatabaseManager $database,
        ProductsRepository $productsRepository
    ) {
        $this->database = $database;
        $this->productsRepository = $productsRepository;
    }

    public function find($id){
        return $this->productsRepository->find($id);
    }

    public function findAll($params){
        $products = new Products();
        $queries = [];

        $filtros = $params['filters'];

        foreach($this->allowedFilters as $filter){
            if(isset($filtros[$filter])){
                $queries[$filter] = $filtros[$filter];
                $products = $products->where($filter, $filtros[$filter]);
            }
        }

        if(isset($params['q'])){
            $queries['nome'] = $params['q'];
            $products = $products->where('nome','ilike', '%'.$params['q'] .'%');
        }

        if(isset($params['sort'])){
            $queries['sort'] = $params['sort'];
            $products = $products->orderBy($params['sort']);
        }
        
        $per_page = isset($params['per_page']) ? $params['per_page'] : 3;
        return $products->paginate($per_page)->appends($queries);

    }

    public function store(Request $request){
        try {
            $this->database->beginTransaction();
            
            $this->productsRepository->store($request);
            
            $this->database->commit();
        } catch (\Exception $e) {
            $this->database->rollBack();
            throw $e;
        }
    }
}
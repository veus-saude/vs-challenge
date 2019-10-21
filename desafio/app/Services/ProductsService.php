<?php

namespace App\Services;

use Illuminate\Database\DatabaseManager;
use App\Repositories\ProductsRepository;
use App\Products;
use Illuminate\Http\Request;


class ProductsService {

    /**
     * @var ProductsRepository
     */
    protected $productsRepository;

    public function __construct( DatabaseManager $dm, ProductsRepository $productsRepository ) 
    {
        $this->dm = $dm;
        $this->productsRepository = $productsRepository;
    }
    public function find($id)
    {
        return $this->productsRepository->find($id);
    }

    public function findAll($params)
    {
       return $this->productsRepository->findAll($params);
    }
    public function store(Request $request)
    {
        try 
        {
            $this->dm->beginTransaction();
            $this->productsRepository->store($request);
            $this->dm->commit();
        } 
        catch (\Exception $e) 
        {
            $this->dm->rollBack();
            throw $e;
        }
    }
}
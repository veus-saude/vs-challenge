<?php

namespace App\Repositories;

use App\Product;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductRepository implements ProductRepositoryInterface
{
    
    protected $model;

    public function __construct(Product $model)
    {
        $this->model = $model;
    }

    public function getAll($request) : LengthAwarePaginator 
    {
        $direction = 'asc'; 
        $filter = [];
        
        if($request->query('filter')) {
           $filter = $this->getFilters($request->query('filter'));          
        }

        if($request->query('sortBy')) {
           $this->getSortAvailable($request->query('sortBy'));         

            

            if($request->has('direction')) {
                $direction = $request->query('direction');
            }
        }


        $result = Product::with('brand')                        
                        ->when($request->has('q'), function ($q) use ($request){
                            return $q->where('name', 'like', '%'.$request->query('q').'%');
                        })
                        ->when(!empty($filter), function ($q) use ($filter) {
                            $q->whereHas('brand', function ($query) use ($filter) {
                                return $query->where('name', $filter['value']);
                            });
                        })
                        ->when($request->has('sortBy'), function ($q) use ($request, $direction) {
                            return $q->orderBy($request->query('sortBy'), $direction);
                        })
                        ->paginate();
       
        return $result;
    }


    public function getFilters(string $qryString) : array
    {
        $filter = [];
        $filters = explode(':', $qryString);    
        
        if(!empty($filters)) {
            $filter['field'] = strtolower($filters[0]);
            $filter['value'] = $filters[1];
        }

        if(!in_array($filter['field'], (new $this->model)->getFiltersAvailable())) {
            throw new \Exception('Filter '.$filter['field'].' not found', 422);
        }       

        return $filter;
    }

    public function getSortAvailable(string $qryString) : bool
    {
        if(!in_array($qryString, (new $this->model)->getSortAvailable())) {
            throw new \Exception('Sort by '.$qryString.' not found', 422);
        }       

        return true;
    }

    public function getById($id) : Product
    {
        $product = $this->model::with('brand')->find($id);

        if(!$product) {
            throw new \Exception('Product not found', 422);
        }
        return $product;
    }

    public function create (array $attributes) : Product
    {
        return $this->model::create($attributes);
    }

    public function update (Product $obj, array $attributes) : Product 
    {
        $obj->fill($attributes)->save();
        return($obj);
    }

    public function delete (Product $obj) : bool 
    {        
        return $obj->delete();
    }

    public function getFields() : Array
    {
        return (new $this->model)->getFillable();
    }

    
}
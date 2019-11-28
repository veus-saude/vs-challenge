<?php

namespace App\Traits;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use App\Models\Helpers;

trait QueryAuxTrait {
 
    public function index($request = null)
    {
        $results = $this;
        $selects = $this->table . '.*';
        
        // Search by query string parameters "p"
        $this->search($request, $results);
        
        // Get filters
        $this->filter($request, $results, $selects);
        
        // &sort=name|desc,price|asc
        $this->order($request, $results);
        
        return $results->selectRaw($selects)->paginate($this->per_page);
    }
    
    public function search($request, &$results)
    {
        if ($request->has('q')) {
            $results = $results->where($this->table . '.name', 'LIKE', "%".$request->q."%");
        }
    }
    
    public function filter($request, &$results, &$selects)
    {
        if ($request->has('filter')) {
            $params = Helpers::getFilters($request);
            
            if (Schema::hasColumn($this->table, $params['column'])) {
                $results = $results->where($this->table . '.' . $params['column'], $params['value']);
            } else {
                
                $table_singular = $params['column'];
                $table = Str::plural($params['column']);
                
                if (Schema::hasTable($table)) {
                    $results = $results->join($table, $table . '.id', '=', $this->table . '.' . $table_singular . '_id');
                    $results = $results->where($table . '.name', $params['value']);
                    
                    $selects .= ', ' . $table . '.name as ' . $table_singular . '_name';
                }
            }
        }
    }
    
    public function order($request, &$results)
    {
        if ($request->has('sort')) {
            $orderings = Helpers::getOrderings($request);
            foreach ($orderings as $order) {
                $results = $results->orderBy($this->table . '.' . $order['field'], $order['direction']);
            }
        }
    }
    
}
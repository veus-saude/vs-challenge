<?php

namespace App\Models;

use Illuminate\Support\Str;

class Helpers {
    
    public static function getFilters($request)
    {
        $filter = explode(':', $request->filter);
        $column = $filter[0];
        $value  = $filter[1];
        
        return [
            'column' => $column,
            'value'  => $value
        ];
    }
    
    public static function getOrderings($request)
    {
        $orderings = array();
        
        // There is at least one ordering request
        if (!empty($request->sort)) {
            
            // Verify if there is more than one ordering request
            if (Str::contains($request->sort, ',')) {
                
                $terms = explode(',', $request->sort);
                
                foreach ($terms as $order) {
                    if (Str::contains($order, '|')) {
                        $order = explode('|', $order);
                        $field     = $order[0];
                        $direction = $order[1];
                        
                        $orderings[] = [
                            'field'     => $field, 
                            'direction' => $direction
                        ];
                    } else {
                        // Order by field , ASC (DEFAULT)
                        $orderings[] = [
                            'field'     => $order,
                            'direction' => 'ASC'
                        ];
                    }
                }
                
            } else {
                if (Str::contains($request->sort, '|')) {
                    $order = explode('|', $request->sort);
                    $field     = $order[0];
                    $direction = $order[1];

                    $orderings[] = [
                        'field'     => $field, 
                        'direction' => $direction
                    ];
                } else {
                    // Order by field , ASC (DEFAULT)
                    $orderings[] = [
                        'field'     => $request->sort,
                        'direction' => 'ASC'
                    ];
                }
            }
        }
        
        return $orderings;
    }
    
}
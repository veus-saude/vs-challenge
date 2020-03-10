<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    protected $fillable = ['name', 'brand', 'price', 'quantity'];
    
    /**
     * Dados para geração do gráfico
     * @return \stdClass
     */
    public static function chartData(): object
    {   
        $products = DB::table('products')
            ->selectRaw('MONTH(created_at) AS month, COUNT(*) AS totals_products')
            ->groupBy('month')
            ->get();
        
        foreach($products as $product) {
            $months[] = convert_month($product->month);
            $totals[] = $product->totals_products;
        }
        
        $chartData = new \stdClass();
        $chartData->months = "'" . implode("','", $months) . "'";
        $chartData->totals = "'" . implode("','", $totals) . "'";
        
        return $chartData;
    }
}

<?php

use Illuminate\Database\Seeder;
use App\Models\Api\v1\Product;
use App\Models\Api\v1\Brand;
use Illuminate\Support\Str;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $products = [
            'Seringa',
            'Bisturi',
            'Luvas',
            'Alcool Iodado',
            'Esterilizador'
        ];
        
        $details = [
            ' - Grande',
            ' - Par',
            ' - Cirúrgico'
        ];
        
        
        for ($i = 1; $i <= 20; $i++) {
        
            $p_choosen = array_rand($products);
            $d_choosen = array_rand($details);
            $brand = Brand::orderByRaw('RAND()')->first();

            Product::create([
                'name' => $products[$p_choosen] . $details[$d_choosen],
                'brand_id' => $brand->id
            ]);
            
        }
    }
}

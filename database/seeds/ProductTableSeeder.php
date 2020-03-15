<?php

use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('product')->delete();
        
        \DB::table('product')->insert(array (
            0 => 
            array (
                'product_id' => 3,
                'name' => 'Luva Cirurgica',
                'price' => '9',
                'quantity' => 199,
                'brand_id' => 3,
            ),
            1 => 
            array (
                'product_id' => 4,
                'name' => 'Luva',
                'price' => '10',
                'quantity' => 10,
                'brand_id' => 1,
            ),
            2 => 
            array (
                'product_id' => 5,
                'name' => 'Luva',
                'price' => '10',
                'quantity' => 10,
                'brand_id' => 1,
            ),
            3 => 
            array (
                'product_id' => 6,
                'name' => 'Luva',
                'price' => '10',
                'quantity' => 10,
                'brand_id' => 1,
            ),
            4 => 
            array (
                'product_id' => 7,
                'name' => 'Coletor de materiais',
                'price' => '1',
                'quantity' => 5,
                'brand_id' => 9,
            ),
            5 => 
            array (
                'product_id' => 8,
                'name' => 'Cateter',
                'price' => '0',
                'quantity' => 30,
                'brand_id' => 5,
            ),
        ));
        
        
    }
}
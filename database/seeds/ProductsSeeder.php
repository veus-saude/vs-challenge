<?php

use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Source\Produtcs::class, 300)->create()->each(function(\App\Source\Produtcs $product){
            factory(\App\Source\Stokes::class, 1)->create([
                'id_product' => $product->getId()
            ]);
        });
    }
}

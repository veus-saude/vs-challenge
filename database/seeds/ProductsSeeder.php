<?php

use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Seed the application's database with products.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Product::class, 100)->create();
    }
}

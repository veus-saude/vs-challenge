<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 30; $i++) {
            DB::table('products')->insert([
                'name' => "Seringa $i",
                'brand' => 'BUNZL',
                'unit_price' => 6.66 + $i,
                'quantity' => 666 + $i,
            ]);
        }

        factory(\App\Product::class, 1000)->create();
    }
}

<?php

use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('product')->insert([
            'product_name' => Str::random(10),
            'brand_id' => 1,
            'product_price' => 10.2,
            'product_qty' => 3,
        ]);
    }
}

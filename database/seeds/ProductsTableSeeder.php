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
        $brand = app(\App\Repositories\BrandRepository::class)->all();
        $products = factory(\App\Models\Product::class,30)->make();
        $products->each(function($product) use($brand){
            $product->brand_id = $brand->random()->id;
            $product->save();
        });
    }
}

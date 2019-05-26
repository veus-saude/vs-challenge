<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use App\Product;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=1; $i<=50; $i++){

            $products = new Product();
            $products->name = "seringa ".Str::random(5);
            $products->brand = 'BUNZL';
            $products->save();

            $products = new Product();
            $products->name = "seringa ".Str::random(5);
            $products->brand = 'XPOT';
            $products->save();

            $products = new Product();
            $products->name = "Agulha ".Str::random(5);
            $products->brand = 'BUNZL';
            $products->save();

            $products = new Product();
            $products->name = "Agulha ".Str::random(5);
            $products->brand = 'XPOT';
            $products->save();
        }
    }
}

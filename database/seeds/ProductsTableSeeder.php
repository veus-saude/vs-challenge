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
            $products->price = 20.80;
            $products->qtd = 30;
            $products->save();

            $products = new Product();
            $products->name = "seringa ".Str::random(5);
            $products->brand = 'XPOT';
            $products->price = 17.35;
            $products->qtd = 60;
            $products->save();

            $products = new Product();
            $products->name = "Agulha ".Str::random(5);
            $products->brand = 'BUNZL';
            $products->price = 11.89;
            $products->qtd = 80;
            $products->save();

            $products = new Product();
            $products->name = "Agulha ".Str::random(5);
            $products->brand = 'XPOT';
            $products->price = 12.15;
            $products->qtd = 97;
            $products->save();

        }
    }
}

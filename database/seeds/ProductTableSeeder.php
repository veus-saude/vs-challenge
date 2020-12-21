<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Product;

class ProductTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('products')->delete();
        $product1 = Product::create([
            'name'                 =>'Seringa',
            'brand'                =>'Bunzl',
            'price'                =>15.00,
            'stock'                =>30
        ]);
        $product2 = Product::create([
            'name'                 =>'Seringa',
            'brand'                =>'Bnjex',
            'price'                =>30.00,
            'stock'                =>15
        ]);
        $product3 = Product::create([
            'name'                 =>'Seringa',
            'brand'                =>'Embramac',
            'price'                =>60.00,
            'stock'                =>2
        ]);
        $product4 = Product::create([
            'name'                 =>'Luva Cirúrgica',
            'brand'                =>'Nugard',
            'price'                =>16.00,
            'stock'                =>18
        ]);
        $product5 = Product::create([
            'name'                 =>'Luva Cirúrgica',
            'brand'                =>'Descarpack',
            'price'                =>69.00,
            'stock'                =>11
        ]);
        $product6 = Product::create([
            'name'                 =>'Luva Cirúrgica',
            'brand'                =>'Talge',
            'price'                =>19.00,
            'stock'                =>18
        ]);
    }
}

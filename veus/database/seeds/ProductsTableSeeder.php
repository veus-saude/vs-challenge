<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        DB::table('products')->insert([
            ['name' => 'Seringas Hipodérmicas Convencionais-3ml', 'brand' => 'BUNZL', 'price' => 69.86, 'stock' => 80],
            ['name' => 'Seringas Hipodérmicas Convencionais-5ml', 'brand' => 'BUNZL', 'price' => 89.56, 'stock' => 85],
            ['name' => 'Seringas Hipodérmicas Convencionais-60ml - Cateter', 'brand' => 'BUNZL', 'price' => 129.35, 'stock' => 122],
            ['name' => 'Seringas Hipodérmicas Convencionais-60ml - Luer Lock', 'brand' => 'BUNZL', 'price' => 135.20, 'stock' => 100],
            ['name' => 'Seringas Hipodérmicas Convencionais-60ml - Luer Slip', 'brand' => 'BUNZL', 'price' => 149.90, 'stock' => 130],
            ['name' => 'Seringas Hipodérmicas Convencionais-20ml - Luer Slip', 'brand' => 'BUNZL', 'price' => 86.17, 'stock' => 20],
        ]);
    }
}

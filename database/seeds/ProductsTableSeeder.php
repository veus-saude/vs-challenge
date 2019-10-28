<?php

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
        Product::create([
            'nome'      => 'Xarope infantil',
            'marca'     => 'xpto',
            'preco'     => 25.50,
            'estoque'     => 10,
        ]);
    }
}

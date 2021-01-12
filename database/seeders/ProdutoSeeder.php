<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ModelProduto;

class ProdutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(ModelProduto $produto)
    {
        $produto->create([
            'name'=>'Seringa',
            'brand'=>'Diversos',
            'price'=>'1.99',
            'quantity'=>'100'
        ]);
    }
}

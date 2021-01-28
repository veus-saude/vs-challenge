<?php

namespace Database\Seeders;

use App\Models\Produto;
use Illuminate\Database\Seeder;

class ProdutosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Produto::create([
            'nome'      => 'Camisa',
            'marca'     => 'Adidas',
            'preco'     => '199.90',
            'qtd'       => '105'
        ]);
    }
}

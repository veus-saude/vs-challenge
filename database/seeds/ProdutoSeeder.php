<?php

use Illuminate\Database\Seeder;

class ProdutoSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        App\Produtos::create([
            'nome' => str_random(10),
            'marca' => str_random(10),
            'quantidade' => rand(1,100),
            'preco' => rand(10,200),
        ]);
    }
}

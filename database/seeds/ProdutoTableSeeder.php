<?php

use App\Models\Produto;
use Illuminate\Database\Seeder;

class ProdutoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get("database/dump/produtos.json");
        if (!empty($json)) {
            $dados = json_decode($json);
            foreach ($dados as $dado) :
                Produto::create([
                    'id' => $dado->id,
                    'nome' => $dado->nome,
                    'preco' => $dado->preco,
                    'brand' => $dado->brand,
                    'qtd_estoque' => $dado->qtd_estoque,
                    'created_at' => $dado->created_at,
                    'updated_at' => $dado->updated_at
                ]);
            endforeach;
        }
    }
}

<?php

namespace Tests\Feature\Models;

use App\Models\Produtos;
use App\Repository\ProdutosRepository;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProdutosTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testSave()
    {
        $prod = new Produtos([
            "nome" => "Teste 002",
            "marca" => "Marca 01",
            "preco" => 100,
            "quantidade" => 30
        ]);

        $this->assertTrue($prod->save());
    }

    public function testFind()
    {
        factory('App\Models\Produtos', 10)->create();
        $pRepository = new ProdutosRepository();
        $totalItens = $pRepository->buscar()->get();
        $this->assertEquals(10, count($totalItens));
    }
}

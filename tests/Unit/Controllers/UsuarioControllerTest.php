<?php

namespace Tests\Feature\Models;

use App\Models\Produtos;
use App\Models\Usuarios;
use App\Repository\ProdutosRepository;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tymon\JWTAuth\JWTAuth;

class UsuarioControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testToken()
    {
        (new Usuarios([
            'email' => 'teste',
            'password' => '1234',
            'name' => 'Testando'
        ]))->save();

        $response = $this->post('/token', [
            'email' => 'teste',
            'password' => '1234'
        ]);
        $response->assertStatus(200);
        //dd($response->json("token"));
    }
}

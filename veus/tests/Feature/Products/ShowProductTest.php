<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class ShowProductTest extends TestCase
{
    /**
     * Defino que não quero que os middlewares sejam invocados
     * para os controllers ( não quero testar o middleware de autenticacao )
     */
    use WithoutMiddleware;

    /**
     * Show Product
     *
     * @return void
     */
    public function testShowProductTest()
    {
        $path = '/api/products/10';

        $response = $this->json('GET', $path);
        $response->assertStatus(200)
                ->assertJsonStructure([
                    'name', 'brand', 'price', 'stock', 'created_at', 'updated_at'
                ]);
    }
}

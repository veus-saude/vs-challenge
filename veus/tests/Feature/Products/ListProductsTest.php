<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class ListProductsTest extends TestCase
{
    /**
     * Defino que não quero que os middlewares sejam invocados
     * para os controllers ( não quero testar o middleware de autenticacao )
     */
    use WithoutMiddleware;

    /**
     * List of Products.
     *
     * @return void
     */
    public function testListProductsTest()
    {
        $path = '/api/products';

        $response = $this->call('GET', $path, [], ['Accept' => 'application/json']);
        $response->assertStatus(200)
                ->assertJsonStructure([
                    [ 'name', 'brand', 'price', 'stock', 'created_at', 'updated_at' ]
                ]);
    }
}

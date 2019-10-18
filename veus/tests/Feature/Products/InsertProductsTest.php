<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class InsertProductsTest extends TestCase
{
    /**
     * Defino que não quero que os middlewares sejam invocados
     * para os controllers ( não quero testar o middleware de autenticacao )
     */
    use WithoutMiddleware;

    /**
     * Inserction of Products.
     *
     * @return void
     */
    public function testInsertProductsTest()
    {
        $path = '/api/products';

        $product = [
            'name' => 'Testing Product',
            'brand' => 'Testing',
            'price' => 10.20,
            'stock' => 50
        ];

        $response = $this->json('POST', $path, $product);
        $response->assertStatus(200)
                ->assertJson([
                    'success' => true
                ]);
    }
}

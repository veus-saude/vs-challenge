<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class UpdateProductsTest extends TestCase
{
    /**
     * Defino que não quero que os middlewares sejam invocados
     * para os controllers ( não quero testar o middleware de autenticacao )
     */
    use WithoutMiddleware;

    /**
     * Update of Products.
     *
     * @return void
     */
    public function testUpdateProductsTest()
    {
        $path = '/api/products/6';

        $product = [
            'name' => 'Updated Product Testing',
            'brand' => 'Testing',
            'price' => 50,
            'stock' => 10
        ];

        $response = $this->json('PUT', $path, $product);
        $response->assertStatus(200)
                ->assertJson([
                    'success' => true
                ]);

        $responseGetProduct = $this->json('GET', $path);
        $updatedProduct = json_decode($responseGetProduct->content(), true);

        $this->assertEquals($updatedProduct['name'], $product['name']);
        $this->assertEquals($updatedProduct['brand'], $product['brand']);
        $this->assertEquals($updatedProduct['price'], $product['price']);
        $this->assertEquals($updatedProduct['stock'], $product['stock']);
    }
}

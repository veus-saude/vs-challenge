<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class DeleteProductsTest extends TestCase
{
    /**
     * Defino que não quero que os middlewares sejam invocados
     * para os controllers ( não quero testar o middleware de autenticacao )
     */
    use WithoutMiddleware;

    /**
     * List of products
     */
    protected $products;


    public function setUp(): void {
        parent::setUp();


        // Insert a product to be deleted
        $this->insertProduct();
        // Fill in the products
        $this->fillProducts();
    }

    /**
     * Insert a product to be deleted
     */
    public function insertProduct() {
        $path = '/api/products';

        $product = [
            'name' => 'Testing Product Deletion',
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

    /**
     * Fill in the products before deleting
     */
    public function fillProducts() {
        $path = '/api/products';
        $response = $this->json('GET', $path, ['sort' => 'created_at:DESC']);
        $this->products = json_decode($response->content(), true);
    }

    /**
     * Update of Products.
     *
     * @return void
     */
    public function testDeleteProductsTest()
    {
        $this->assertTrue(count($this->products) > 0);

        $path = '/api/products/'.$this->products[0]['id'];

        $response = $this->json('DELETE', $path);
        $response->assertStatus(200)
                ->assertJson([
                    'success' => true
                ]);

        $responseGetProduct = $this->json('GET', $path);
        $responseGetProduct->assertStatus(404)
                           ->assertJsonStructure([
                               'error'
                           ]);
    }
}

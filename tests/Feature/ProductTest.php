<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Testando listagem básica de produtos.
     *
     * @return void
     */
    public function testListProducts()
    {
        $this->seed();
        $response = $this->get('/api/v1/product/');

        $response
            ->assertStatus(200)
            ->assertJsonStructure(
                [
                    ['id', 'name', 'brand', 'price', 'store', 'deleted_at', 'created_at', 'updated_at']
                ]
            );
    }

    /**
    * Testando registro de produto
    *
    * @return void
    */
    public function testRegisterProducts()
    {
        $response = $this->json(
            'POST', 
            '/api/v1/product', 
            [
                'name' => 'Luvas de Procedimento', 
                'brand' => 'Supermax',
                'price' => 226.8,
                'store' => 5
            ]
        );

        $response
            ->assertStatus(201)
            ->assertJsonFragment(
                [
                    'name' => 'Luvas de Procedimento', 
                    'brand' => 'Supermax',
                    'price' => 226.8,
                    'store' => 5
                ]
            );
    }

    /**
     * Testando exibição de um produto.
     *
     * @return void
     */
    public function testShowProduct()
    {
        $this->artisan('migrate:refresh');
        $this->seed();

        $response = $this->get('/api/v1/product/13');

        $response
            ->assertStatus(200)
            ->assertJsonFragment(['id' => 13])
            ->assertJsonStructure(
                ['id', 'name', 'brand', 'price', 'store', 'deleted_at', 'created_at', 'updated_at']
            );
    }

    /**
     * Testando atualização de um produto.
     *
     * @return void
     */
    public function testUpdateProduct()
    {
        $this->artisan('migrate:refresh');
        $this->seed();

        $product = \App\Product::where('store', '>', 100)->get();

        $response = $this->json(
            'PATCH',
            '/api/v1/product/' . $product[0]->id,
            ['store' => 50]
        );

        $response   
            ->assertStatus(200)
            ->assertJsonFragment(['store' => 50]);
    }

    /**
     * Testando deleção de um produto.
     *
     * @return void
     */
    public function testSoftDeleteProduct()
    {
        $this->seed();

        $product = \App\Product::limit(1)->get()[0];

        $response = $this->json('DELETE', '/api/v1/product/' . $product->id);

        $response->assertStatus(200);
        $this->assertSoftDeleted('products', ['id' => $product->id]);
    }

    /**
     * Testando paginação de produtos.
     *
     * @return void
     */
    public function testProductsPaginatingSize()
    {
        $this->seed();
        $response = $this->get('/api/v1/product?page=1&size=5');

        $response
            ->assertStatus(200)
            ->assertJsonCount(5);
    }
}

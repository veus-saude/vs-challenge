<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;

class ProductsTest extends TestCase
{
    /**
     *
     * @return void
     */
    public function testProductsAcess()
    {
        $user = factory(User::class)->make();
        $response = $this->actingAs($user)->get('/products');
        $response->assertStatus(200);
    }

    /**
     *
     * @return void
     */
    public function testProductsCreate()
    {
        $product = [
            'nome' => 'ABC',
            'marca' => 'CDE',
            'preco' => 200,
            'quantidade' => 5
        ];

        $user = factory(User::class)->make();
        $response = $this->actingAs($user)->post('/products', $product);
        $response->assertStatus(302)
        ->assertRedirect('products');
    }

    /**
     *
     * @return void
     */
    public function testProductsUpdate()
    {
        $product = [
            'preco' => 450
        ];

        $user = factory(User::class)->make();
        $response = $this->actingAs($user)->put('/products/200', $product);
        $response->assertStatus(302)
        ->assertRedirect('products');
    }
}

<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class ProductsTest extends TestCase
{
    
    /**
     *
     * @return void
     */
    public function testProductsAcess()
    {
        $user = factory(User::class)
        ->make();

        $response = $this->actingAs($user)
        ->get('/products');

        $response->assertStatus(200);
    }

    
    /**
     *
     * @return void
     */

    public function testProductsCreate()
    {
        $product = [
            'name' => 'TestName',
            'brand' => 'TestBrand',
            'price' => 10,
            'stock' => 8
        ];

        $user = factory(User::class)->make();
        
        $response = $this->actingAs($user)
        ->post('/products', $product);
        
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
            'name' => 'TesteName2'
        ];

        $user = factory(User::class)->make();
        
        $response = $this->actingAs($user)
        ->put('/products/200', $product);

        $response->assertStatus(302)
        ->assertRedirect('products');
    }
}
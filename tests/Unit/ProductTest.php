<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Artisan;

class ProductTest extends TestCase
{
    private $loginCredentials = [
        'email' => 'admin@example.com',
        'password' => 'secret'
    ];

    private $product = [
        'name' => 'Product Test 1',
        'brand' => 'Brand Test 1',
        'price' => 49.90,
        'stock' => 10,
    ];

    private $invalidProduct = [
        'name' => 'Product Test 1',
        'brand' => 'Brand Test 1',
        'price' => 49.90,
    ];

    private $repeatedProduct = [
        'name' => 'Product Test 1',
        'brand' => 'Brand Test 1',
        'price' => 59.90,
        'stock' => 20,
    ];

    private $updatedProductData = [
        'stock' => 5
    ];

    /**
     * Test authentication
     *
     * @return void
     */
    /** @test */
    public function authentication()
    {
        $response = $this->json('POST', '/api/'. config('app.api_version') . '/products', $this->product);

        $response->assertStatus(401);
    }

    /**
     * Test product list
     *
     * @return void
     */
    /** @test */
    public function list()
    {
        $jwtToken = $this->getJwtToken();

        $response = $this->withHeaders([
                'Authorization' => 'Bearer ' . $jwtToken,
            ])
            ->json('GET', '/api/'. config('app.api_version') . '/products');
        
        $response->assertStatus(200);

        $this->assertEquals($response->getData()->total, 3);
    }

    /**
     * Test create
     *
     * @return void
     */
    /** @test */
    public function create()
    {
        $this->withoutMiddleware();

        $response = $this->json('POST', '/api/'. config('app.api_version') . '/products', $this->product);

        $response->assertStatus(201);
    }

    /**
     * Test create validation
     *
     * @return void
     */
    /** @test */
    public function createValidation()
    {
        $this->withoutMiddleware();

        $response = $this->json('POST', '/api/'. config('app.api_version') . '/products', $this->invalidProduct);

        $response->assertStatus(422);
    }

    /**
     * Test create uniqueness
     *
     * @return void
     */
    /** @test */
    public function createUniqueness()
    {
        $this->withoutMiddleware();

        $response = $this->json('POST', '/api/'. config('app.api_version') . '/products', $this->repeatedProduct);

        $response->assertStatus(422);
    }

    /**
     * Test product show
     *
     * @return void
     */
    /** @test */
    public function show()
    {
        $jwtToken = $this->getJwtToken();

        $response = $this->withHeaders([
                'Authorization' => 'Bearer ' . $jwtToken,
            ])
            ->json('GET', '/api/'. config('app.api_version') . '/products/1');
        
        $response->assertStatus(200)
            ->assertJson([
                'id' => 1,
                'name' => 'Product 1',
                'brand' => 'Brand 1',
                'price' => 10.0,
                'stock' => 10
            ]);
    }

    /**
     * Test product update
     *
     * @return void
     */
    /** @test */
    public function update()
    {
        $jwtToken = $this->getJwtToken();

        $response = $this->withHeaders([
                'Authorization' => 'Bearer ' . $jwtToken,
            ])
            ->json('PUT', '/api/'. config('app.api_version') . '/products/1', $this->updatedProductData);
        
        $response->assertStatus(200)
            ->assertJson([
                'product' => [
                    'id' => 1,
                    'name' => 'Product 1',
                    'brand' => 'Brand 1',
                    'price' => 10.0,
                    'stock' => 5
                ]
            ]);
    }

    /**
     * Test product update uniqueness.
     *
     * @return void
     */
    /** @test */
    public function updateUniqueness()
    {
        $jwtToken = $this->getJwtToken();

        $response = $this->withHeaders([
                'Authorization' => 'Bearer ' . $jwtToken,
            ])
            ->json('PUT', '/api/'. config('app.api_version') . '/products/1', $this->repeatedProduct);
        
        $response->assertStatus(422);
    }

    /**
     * Test product update destroy.
     *
     * @return void
     */
    /** @test */
    public function destroy()
    {
        $jwtToken = $this->getJwtToken();

        $response = $this->withHeaders([
                'Authorization' => 'Bearer ' . $jwtToken,
            ])
            ->json('DELETE', '/api/'. config('app.api_version') . '/products/3');
        
        $response->assertStatus(200);

        $response = $this->withHeaders([
                'Authorization' => 'Bearer ' . $jwtToken,
            ])
            ->json('GET', '/api/'. config('app.api_version') . '/products/3')
            ->assertStatus(404);
    }

    private function getJwtToken()
    {
        $response = $this->json('POST', '/api/'. config('app.api_version') . '/auth/login', $this->loginCredentials)
            ->getData();

        return $response->access_token;
    }
}

<?php

namespace Tests\Unit;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Artisan;

class ProductTest extends TestCase
{
    private $product = [
        'name' => 'Product 1',
        'brand' => 'Brand 1',
        'price' => 49.90,
        'stock' => 10,
    ];

    private $invalidProduct = [
        'name' => 'Product 1',
        'brand' => 'Brand 1',
        'price' => 49.90,
    ];

    /**
     * Test authentication
     *
     * @return void
     */
    /** @test */
    public function authentication()
    {
        $response = $this->json('POST', '/api/v1/products', $this->product);
        $response->assertStatus(401);
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

        $response = $this->json('POST', '/api/v1/products', $this->product);

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

        $response = $this->json('POST', '/api/v1/products', $this->invalidProduct);

        $response->assertStatus(422);
    }

    // /**
    //  * Test product show
    //  *
    //  * @return void
    //  */
    // /** @test */
    // public function show()
    // {
    //     $this->withoutMiddleware();

    //     $createResponse = $this->json('POST', '/api/v1/products', $this->product)->getData();

    //     $showResponse = $this->json('GET', '/api/v1/products/' . $createResponse->product->id);

    //     $response->assertStatus(200);
    // }
}

<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testListProducts()
    {
        $response = $this->get('/api/v1/product/');

        $response
            ->assertStatus(200)
            ->assertJsonStructure(
                [
                    ['id', 'name', 'brand', 'price', 'store', 'deleted_at', 'created_at', 'updated_at']
                ]
            );
    }
}

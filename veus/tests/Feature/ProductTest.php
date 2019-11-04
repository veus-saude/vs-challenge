<?php

namespace Tests\Feature;

use App\Product;
use App\User;
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
    public function testsProductsAreCreatedCorrectly()
    {
        $user = factory(User::class)->create();
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];
        $payload = [
            'name' => 'SERINGA',
            'brand' => 'BUNZL',
            'price' => 10,
            'stock' => 100
        ];

        $this->json('POST', '/api/v1/products', $payload, $headers)
            ->assertStatus(201)
            ->assertJson([
                'name' => 'SERINGA',
                'brand' => 'BUNZL',
                'price' => 10,
                'stock' => 100
            ]);
    }

    public function testsProductsAreUpdatedCorrectly()
    {
        $user = factory(User::class)->create();
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];
        $product = factory(Product::class)->create([
            'name' => 'SERINGA',
            'brand' => 'BUNZL',
            'price' => 10,
            'stock' => 100
        ]);

        $payload = [
            'name' => 'SERINGS',
            'brand' => 'BUNZLS',
            'price' => 12,
            'stock' => 120
        ];

        $response = $this->json('PUT', '/api/v1/products/' . $product->id, $payload, $headers)
            ->assertStatus(200)
            ->assertJson([
                'id' => 1,
//                'created_at' => '',
//                'updated_at' => '',
                'name' => 'SERINGA',
                'brand' => 'BUNZL',
                'price' => 10,
                'stock' => 100
            ]);
    }

    public function testsProductsAreDeletedCorrectly()
    {
        $user = factory(User::class)->create();
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];
        $product = factory(Product::class)->create([
            'name' => 'SERINGA',
            'brand' => 'BUNZL',
            'price' => 10,
            'stock' => 100
        ]);

        $this->json('DELETE', '/api/v1/products/' . $product->id, [], $headers)
            ->assertStatus(204);
    }

    public function testProductsAreListedCorrectly()
    {
        factory(Product::class)->create([
            'name' => 'SERINGA',
            'brand' => 'BUNZL',
            'price' => 10,
            'stock' => 100
        ]);

        factory(Product::class)->create([
            'name' => 'OUTRA SERINGA',
            'brand' => 'BUNZL',
            'price' => 11,
            'stock' => 110
        ]);

        $user = factory(User::class)->create();
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];

        $response = $this->json('GET', '/api/v1/products', [], $headers)
            ->assertStatus(200)
            ->assertJson([
                [
                    'name' => 'SERINGA',
                    'brand' => 'BUNZL',
                    'price' => 10,
                    'stock' => 100
                ],
                [
                    'name' => 'OUTRA SERINGA',
                    'brand' => 'BUNZL',
                    'price' => 11,
                    'stock' => 110
                ]
            ])
            ->assertJsonStructure([
                '*' => ['id', 'name', 'brand', 'price', 'stock', 'created_at', 'updated_at'],
            ]);
    }
}

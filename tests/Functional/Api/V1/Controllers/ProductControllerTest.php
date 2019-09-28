<?php

namespace App\Functional\Api\V1\Controllers;

use App\Product;
use App\User;
use Hash;
use App\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ProductControllerTest extends TestCase
{
    use DatabaseMigrations;


    public function setUp(): void
    {
        parent::setUp();

        factory(User::class)->create(['name' => "Fulano", 'email' => 'test@gmail.com', 'password' => '123456']);

        factory(Product::class)->create(['name' => "Seringa", 'brand' => 'Novatel Cirurgica']);
        factory(Product::class)->create(['name' => "Bisturi", 'brand' => 'Belmont']);
        factory(Product::class)->create(['name' => "Tesoura Cirurgica", 'brand' => 'Belmont']);
        factory(Product::class)->create(['name' => "Jaleco Branco", 'brand' => 'Babu']);

    }

    public function testSearchQueryGlobalPartial()
    {
        $response = $this->post('api/auth/login', [
            'email' => 'test@gmail.com',
            'password' => '123456'
        ]);

        $response->assertStatus(200);

        $responseJSON = json_decode($response->getContent(), true);
        $token = $responseJSON['token'];

        $response = $this->get('api/products?q=Cirurg', ['Authorization'  => 'Bearer '.$token], []);

        $response->assertJsonCount(2,"data.data");
    }

    public function testSearchOneFilter()
    {
        $response = $this->post('api/auth/login', [
            'email' => 'test@gmail.com',
            'password' => '123456'
        ]);

        $response->assertStatus(200);

        $responseJSON = json_decode($response->getContent(), true);
        $token = $responseJSON['token'];

        $response = $this->get('api/products?filter=brand:Belmont', ['Authorization'  => 'Bearer '.$token], []);

        $response->assertJsonCount(2,"data.data");
    }


    public function testSearchMultiFilter()
    {
        $response = $this->post('api/auth/login', [
            'email' => 'test@gmail.com',
            'password' => '123456'
        ]);

        $response->assertStatus(200);

        $responseJSON = json_decode($response->getContent(), true);
        $token = $responseJSON['token'];

        $response = $this->get('api/products?filter=brand:Belmont&filter=name:Bisturi', ['Authorization'  => 'Bearer '.$token], []);

        $response->assertJsonCount(1,"data.data");
    }


    public function testPaginate()
    {
        $response = $this->post('api/auth/login', [
            'email' => 'test@gmail.com',
            'password' => '123456'
        ]);

        $response->assertStatus(200);

        $responseJSON = json_decode($response->getContent(), true);
        $token = $responseJSON['token'];

        $response = $this->get('api/products?per_page=2', ['Authorization'  => 'Bearer '.$token], []);

        $response->assertJsonCount(2,"data.data");
    }


    public function testSort()
    {
        $response = $this->post('api/auth/login', [
            'email' => 'test@gmail.com',
            'password' => '123456'
        ]);

        $response->assertStatus(200);

        $responseJSON = json_decode($response->getContent(), true);
        $token = $responseJSON['token'];

        $response = $this->get('api/products?sort=name:asc&per_page=2', ['Authorization'  => 'Bearer '.$token], []);

        $response->assertJsonCount(2,"data.data")
            ->assertJsonFragment(['name' => 'Bisturi'])
            ->assertJsonFragment(['name' => 'Jaleco Branco']);
    }

}

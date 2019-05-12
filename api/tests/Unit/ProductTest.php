<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProductTest extends TestCase
{

    // use RefreshDatabase;
    use WithoutMiddleware;
    use DatabaseTransactions;
    /**
     * A basic unit test example.
     *
     * @return void
     */

    public function testProductIndex(){
        $header     = ['Content-type' => 'application/json' ];
        $response   = $this->json('GET', '/api/v1/products', [], $header);
        $response->assertStatus(200);
    }

    public function testProductCreate(){
        $header         = [ 'Content-type' => 'application/json' ];
        $body_create    = ['name' => 'TEST', 'brand'=>'teste', 'price'=> '1.00', 'amount'=> 1];
        $response       = $this->json('POST', '/api/v1/products', $body_create, $header);
        $response->assertStatus(200);
    }

    public function testProductUpdate(){
        $header         = [ 'Content-type' => 'application/json' ];
        $body_create    = ['name' => 'TEST', 'brand'=>'teste', 'price'=> '1.00', 'amount'=> 1];
        $response       = $this->json('POST', '/api/v1/products', $body_create, $header);
        $response->assertStatus(200);
        $product_created = $response->decodeResponseJson();

        $response   = $this->json('PUT', '/api/v1/products/'.$product_created["data"]['id'], $body_create, $header);
        $response->assertStatus(200);
    }

    public function testProductDate(){
        $header         = [ 'Content-type' => 'application/json' ];
        $body_create    = ['name' => 'TEST', 'brand'=>'teste', 'price'=> '1.00', 'amount'=> 1];
        $response       = $this->json('POST', '/api/v1/products', $body_create, $header);
        $response->assertStatus(200);
        $product_created = $response->decodeResponseJson();

        $response       = $this->json('DELETE', '/api/v1/products/'.$product_created["data"]['id'], [], $header);
        $response->assertStatus(200);
    }
}

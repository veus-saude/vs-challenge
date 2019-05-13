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

    /**
     * Listing products
     * @return void
     */
    public function testProductIndex(){
        $header     = ['Content-type' => 'application/json' ];
        $response   = $this->json('GET', '/api/v1/products', [], $header);
        $response->assertStatus(200);
    }
    /**
     * Creating products
     * 
     * @return void
     */
    public function testProductCreate(){
        $header         = [ 'Content-type' => 'application/json' ];
        $body_create    = ['name' => 'TEST', 'brand'=>'teste', 'price'=> '1.00', 'amount'=> 1];
        $response       = $this->json('POST', '/api/v1/products', $body_create, $header);
        $response->assertStatus(200);
    }

    /**
     * Updating an product
     * 
     * @return void
     */
    public function testProductUpdate(){
        $header         = [ 'Content-type' => 'application/json' ];
        $body_create    = ['name' => 'TEST', 'brand'=>'teste', 'price'=> '1.00', 'amount'=> 1];
        $response       = $this->json('POST', '/api/v1/products', $body_create, $header);
        $response->assertStatus(200);
        $product_created = $response->decodeResponseJson();

        $response   = $this->json('PUT', '/api/v1/products/'.$product_created["data"]['id'], $body_create, $header);
        $response->assertStatus(200);
    }

    /**
     * Delete an product
     * 
     * @return void
     */
    public function testProductDelete(){
        $header         = [ 'Content-type' => 'application/json' ];
        $body_create    = ['name' => 'TEST', 'brand'=>'teste', 'price'=> '1.00', 'amount'=> 1];
        $response       = $this->json('POST', '/api/v1/products', $body_create, $header);
        $response->assertStatus(200);
        $product_created = $response->decodeResponseJson();

        $response       = $this->json('DELETE', '/api/v1/products/'.$product_created["data"]['id'], [], $header);
        $response->assertStatus(200);
    }
}

<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class ProductTest extends TestCase
{
    #use WithoutMiddleware;
    public function testIndex()
    {
        $this->withoutMiddleware();

        $this->json('GET', 'api/v1/products', ['order' => 'price|desc'])
             ->seeJson();

        $this->json('GET', 'api/v1/products', ['name' => 'seringa'])
             ->seeJson();
    }

    public function testShow()
    {
        $this->withoutMiddleware();
         $data = \App\Models\Product::first();
            $this->json('GET', 'api/v1/products/'.$data->id)
             ->seeJson();
    }

    public function testStore()
    {
        $this->withoutMiddleware();
        $this->json('POST', 'api/v1/products', [
                                                'name' => 'Nebulizador', 
                                                'brand' => 'asd', 
                                                'price' => '150.00', 
                                                'quantity' => '80'
                                                ])
             ->seeJson();
    }

    public function testUpdate()
    {
        $this->withoutMiddleware();
        $product = \App\Models\Product::first();
        $product->name = $product->name.'-'.date('s');
        $product->brand = $product->brand.'-'.date('s');
        $this->json('PUT', 'api/v1/products/'.$product->id, $product->toArray())->seeJson();
    }

    public function testDestroy()
    {
        $this->withoutMiddleware();
        $product = \App\Models\Product::where('name','Nebulizador')->first();
        $this->json('DELETE', 'api/v1/products/'.$product->id)->seeJson();
    }

}

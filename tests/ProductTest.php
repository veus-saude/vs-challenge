<?php

use Laravel\Lumen\Testing\DatabaseTransactions;

class ProductTest extends TestCase
{
    use DatabaseTransactions;

    public function testAuth()
    {
        $this->json('GET', '/api/v1/products');

        $this->assertEquals(
            401, $this->response->status()
        );
    }

    public function testGetOne()
    {
        $product = factory('App\Models\Product')->make();

        $this->json('GET', '/api/v1/products/' . $product->id, ['api_token' => 'dev']);

        $this->assertEquals(
            200, $this->response->status()
        );
    }

    public function testGetAll()
    {
        $this->json('GET', '/api/v1/products', ['api_token' => 'dev']);

        $this->assertEquals(
            200, $this->response->status()
        );
    }

    public function testPost()
    {
        $product = factory('App\Models\Product')->make()->toArray();

        $this->json('POST', '/api/v1/products', array_merge($product,[
                'api_token' => 'dev'
            ])
        );

        $this->assertEquals(
            200, $this->response->status()
        );
    }

    public function testPut()
    {
        $product = factory('App\Models\Product')->make();

        $product->save();

        $this->json('PUT', '/api/v1/products/' . $product->id,  [
            'api_token' => 'dev',
            'name' => 'new name',
            'brand' => $product->brand,
            'quantity' => $product->quantity,
            'description' => $product->description,
            'price' => $product->price,
            'thumbnail' => $product->thumbnail,
        ])->seeJson([]);

        echo $this->response->content();

        $this->assertEquals(
            200, $this->response->status()
        );
    }

    public function testDelete()
    {
        $product = factory('App\Models\Product')->make();

        $product->save();

        $this->json('DELETE', '/api/v1/products/' . $product->id, ['api_token' => 'dev'])
            ->seeJson([]);

        $this->assertEquals(
            200, $this->response->status()
        );
    }
}

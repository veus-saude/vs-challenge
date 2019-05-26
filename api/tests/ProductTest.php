<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class ProductTest extends TestCase
{
    //use DatabaseTransactions;

    private static $token;
    private $headers;

    public function setUp() : void
    {
        parent::setUp();

        if (empty(self::$token)) {
            $user = factory(\App\User::class)->create();
            self::$token = $user->api_token;
        }
        $this->headers = [
            'Authorization' => self::$token
        ];
    }
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testUnauthorized()
    {
        $this->get('/api/v1/products');

        $this->assertEquals(401, $this->response->getStatusCode());
    }

    public function testShowProduct()
    {
        $data = factory(\App\Models\Product::class)->create();
        $response = $this->get("api/v1/products/{$data->id}", $this->headers);

        $response->seeJson();
        $response->assertResponseStatus(200);
    }

    public function testNewProduct()
    {
        $data = factory(\App\Models\Product::class)->make();
        $response = $this->json('POST','api/v1/products', $data->toArray(), $this->headers);

        $response->assertResponseStatus(201);
        $this->seeInDatabase('products', $data->toArray());
        $response->seeJsonStructure(['id']);
    }

    public function testNewProductPreconditionFail()
    {
        $data = factory(\App\Models\Product::class)->make();
        unset($data->name);
        $response = $this->json('POST','api/v1/products', $data->toArray(), $this->headers);

        $response->assertResponseStatus(412);
        $response->seeJsonStructure(['messages']);
    }

    public function testUpdateProduct()
    {
        $data = factory(\App\Models\Product::class)->create();
        $dataUp = factory(\App\Models\Product::class)->make();

        $response = $this->json('PUT',"api/v1/products/{$data->id}", $dataUp->toArray(), $this->headers);

        $response->assertResponseStatus(204);
        $this->seeInDatabase('products', $dataUp->toArray());
    }

    public function testUpdateProductNotFound()
    {
        $response = $this->json('PUT',"api/v1/products/0", [], $this->headers);

        $response->assertResponseStatus(404);
    }

    public function testUpdateProductPreconditionFail()
    {
        $data = factory(\App\Models\Product::class)->create();
        $dataUp = factory(\App\Models\Product::class)->make();
        unset($dataUp['name']);

        $response = $this->json('PUT',"api/v1/products/{$data->id}", $dataUp->toArray(), $this->headers);

        $response->assertResponseStatus(412);
        $response->seeJsonStructure(['messages']);
    }

    public function testDeleteProduct()
    {
        $data = factory(\App\Models\Product::class)->create();

        $response = $this->json('DELETE',"api/v1/products/{$data->id}", [], $this->headers);

        $response->assertResponseStatus(204);
    }

    public function testDeleteProductNotFound()
    {
        $response = $this->json('DELETE',"api/v1/products/0", [], $this->headers);

        $response->assertResponseStatus(404);
    }

    public function testSearchProduct()
    {
        $params = [
            'q' => 'sering',
            'filter' => 'brand:BUNZL'
        ];
        $response = $this->get('api/v1/products?' . http_build_query($params), $this->headers);

        $response->seeJson();
        $response->assertResponseStatus(200);
    }

    public function testSearchProductSorting()
    {
        $params = [
            'sort' => 'brand'
        ];
        $response = $this->get('api/v1/products?' . http_build_query($params), $this->headers);

        $response->seeJson();
        $response->assertResponseStatus(200);
    }
}

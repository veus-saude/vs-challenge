<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class ProductsEndpointTest extends TestCase
{
    // public function setUp(){}
    /**
     * api/v1/products [GET]
     */
    public function testGetShowReturnAllProducts()
    {
        $this->get('/api/v1/products');
        $this->seeJsonStructure([
            'data' => [
                '*' =>
                [
                    'name',
                    'description',
                    'sku',
                    'brand',
                    'created_at',
                    'updated_at',
                    'links'
                ]
            ],
            'meta' => [
                '*' => [
                    'total',
                    'count',
                    'per_page',
                    'current_page',
                    'total_pages',
                    'links',
                ]
            ]
        ]);
        $this->seeStatusCode(200);
    }


    /**
     * api/v1/products/1 [GET]
     */
    public function testGetShowReturnOneProduct()
    {
        $this->get('/api/v1/products/1');
        $this->seeJsonStructure([
            'data' => [
                'id',
                'name',
                'description',
                'sku',
                'brand',
                'created_at',
                'updated_at',
                'links'
            ],
        ]);
        $this->seeStatusCode(200);
    }

    /**
     * api/v1/products [POST]
     */
    public function testShouldCreateProducts()
    {
        $payload = [
            'name' => 'Product one',
            'description' => 'Lorem ipsum dolor sit amet',
            'sku' => '0000',
            'brand' => 'BUZNL'
        ];

        $this->post('api/v1/products', $payload);
        $this->seeJsonStructure([
            'data' => [
                'id',
                'name',
                'description',
                'sku',
                'brand',
                'created_at',
                'updated_at',
                'links'
            ],
        ]);
        $this->seeStatusCode(200);
    }

    /**
     * api/v1/products/id [PUT]
     */
    public function testShouldUpdateProduct()
    {
        $parameters = [
            'name' => 'Update product',
            'description' => 'Update product description',
        ];
        $this->put("api/v1/products/4", $parameters, []);
        $this->seeStatusCode(200);
        $this->seeJsonStructure(
            [
                'data' =>
                [
                    'name',
                    'description',
                    'sku',
                    'brand',
                    'created_at',
                    'updated_at',
                    'links'
                ]
            ]
        );
    }
    /**
     * api/v1/products/id [DELETE]
     */
    public function testShouldDeleteProduct()
    {

        $this->delete("api/v1/products/1", [], []);
        $this->seeStatusCode(410);
        $this->seeJsonStructure([
            'status',
            'message'
        ]);
    }
}

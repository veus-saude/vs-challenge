<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class ProductsEndpointTest extends TestCase
{
    // public function setUp(){}
    /**
     * /products [GET]
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
     * /products [GET]
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
}

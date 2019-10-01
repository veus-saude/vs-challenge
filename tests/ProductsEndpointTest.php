<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class ProductsEndpointTest extends TestCase
{
    /**
     * /products [GET]
     */
    public function testGet()
    {
        $this->get('/api/v1/products');
        $this->seeStatusCode(200);

    }
}

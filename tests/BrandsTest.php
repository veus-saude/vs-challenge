<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class BrandsTest extends TestCase
{
    public static $token;

    public static  $id;

    public function testSearch()
    {
        self::$token = \App\Source\User::first()->getToken();

        $response = $this->json('GET','/api/v1/brands', [], [
                'Authorization' => 'Bearer '.self::$token
            ])
            ->seeJsonStructure([
                'data' => []
            ]);

        $this->assertEquals(200, $response->response->status());
    }

    /**
     * @depends testSearch
     */
    public function testCreate()
    {
        $faker = \Faker\Factory::create('pt_BR');

        $response = $this->json('POST','/api/v1/brands', [
            'name' => $faker->company,
        ],[
            'Authorization' => 'Bearer '.self::$token
        ]);

        $this->assertEquals(200, $response->response->status());

        $data = json_decode($response->response->content(), true);

        self::$id = $data['id'];
    }

    /**
     * @depends testCreate
     */
    public function testUpdate()
    {
        $faker = \Faker\Factory::create('pt_BR');

        $response = $this->json('PUT','/api/v1/brands/'.self::$id, [
            'name' => $faker->company,
        ],[
            'Authorization' => 'Bearer '.self::$token
        ]);

        $this->assertEquals(200, $response->response->status());
    }

    /**
     * @depends testUpdate
     */
    public function testDelete()
    {

        $response = $this->json('DELETE','/api/v1/brands/'.self::$id, [],[
            'Authorization' => 'Bearer '.self::$token
        ]);

        $this->assertEquals(200, $response->response->status());
    }
}

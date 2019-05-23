<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class TypesTest extends TestCase
{

    public static $token;

    public static  $id;

    public function testSearch()
    {
        self::$token = \App\Source\User::first()->getToken();

        $response = $this->json('GET','/api/v1/types', [], [
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
    public function testCreate($a)
    {
        $faker = \Faker\Factory::create('pt_BR');

        $response = $this->json('POST','/api/v1/types', [
            'name' => $faker->company,
        ],[
            'Authorization' => 'Bearer '.self::$token
        ]);

        $this->assertEquals(200, $response->response->status());

        $data = json_decode($response->response->content(), true);

        self::$id = $data['id'];
        return $data['id'];
    }

    /**
     * @depends testCreate
     */
    public function testUpdate($id)
    {
        $faker = \Faker\Factory::create('pt_BR');

        $response = $this->json('PUT','/api/v1/types/'.self::$id, [
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
        $response = $this->json('DELETE','/api/v1/types/'.self::$id, [],[
            'Authorization' => 'Bearer '.self::$token
        ]);

        $this->assertEquals(200, $response->response->status());
    }
}

<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
    public static $token;

    public static  $id;

    public function testSearch()
    {
        self::$token = \App\Source\User::first()->getToken();

        $response = $this->json('GET','/api/v1/users', [], [
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

        $response = $this->json('POST','/api/v1/users', [
            'name' => $faker->firstName,
            'last_name' => $faker->lastName,
            'email' => $faker->unique()->email
        ],[
            'Authorization' => 'Bearer '.self::$token
        ]);

        var_dump($response->response->content());
        die();

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

        $response = $this->json('PUT','/api/v1/users/'.self::$id, [
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
        $response = $this->json('DELETE','/api/v1/users/'.self::$id, [],[
            'Authorization' => 'Bearer '.self::$token
        ]);

        $this->assertEquals(200, $response->response->status());
    }
}

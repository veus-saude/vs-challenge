<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp() : void
    {
        parent::setUp();
    }

    public function testNewUser()
    {
        $data = factory(\App\User::class)->make();
        $data = $data->toArray();
        $data['password'] = 'secret';

        $response = $this->json('POST','api/v1/users', $data);

        $response->assertResponseStatus(201);
        unset($data['password'], $data['api_token']);
        $this->seeInDatabase('users', $data);
        $response->seeJsonStructure(['id']);
    }

    public function testNewUserPreconditionFail()
    {
        $data = factory(\App\User::class)->make();

        $response = $this->json('POST','api/v1/users', $data->toArray());

        $response->assertResponseStatus(412);
        $response->seeJsonStructure(['messages']);
    }

    public function testAuthUser()
    {
        $data = factory(\App\User::class)->create()->toArray();
        $data['password'] = 'secret';

        $response = $this->json('POST',"api/v1/users/auth", $data);

        $response->assertResponseStatus(200);
        $response->seeJsonStructure(['token']);
    }

    public function testAuthUserFail()
    {
        $data = ['email' => 'teste@teste.com', 'password' => 'test'];

        $response = $this->json('POST',"api/v1/users/auth", $data);

        $response->assertResponseStatus(404);
        $response->seeJsonStructure(['error']);
    }
}

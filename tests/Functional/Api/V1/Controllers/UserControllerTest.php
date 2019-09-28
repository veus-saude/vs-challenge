<?php

namespace App\Functional\Api\V1\Controllers;

use Hash;
use App\User;
use App\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UserControllerTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();

        $user = new User([
            'name' => 'Fulano',
            'email' => 'test@gmail.com',
            'password' => '123456'
        ]);

        $user->save();
    }

    public function testAccessWithToken()
    {
        $response = $this->post('api/auth/login', [
            'email' => 'test@gmail.com',
            'password' => '123456'
        ]);

        $response->assertStatus(200);

        $responseJSON = json_decode($response->getContent(), true);
        $token = $responseJSON['token'];

        $this->get('api/auth/me?token=' . $token, [], [])->assertJson([
            'name' => 'Fulano',
            'email' => 'test@gmail.com'
        ])->isOk();
    }

    public function testSignUpSuccessfully()
    {
        $this->post('api/auth/register', [
            'name' => 'Fulano 2',
            'email' => 'test2@gmail.com',
            'password' => '123456'
        ])->assertJson([
            'status' => 'ok'
        ])->assertStatus(201);
    }

    public function testLogout()
    {
        $response = $this->post('api/auth/login', [
            'email' => 'test@gmail.com',
            'password' => '123456'
        ]);

        $response->assertStatus(200);

        $responseJSON = json_decode($response->getContent(), true);
        $token = $responseJSON['token'];

        $this->post('api/auth/logout?token=' . $token, [], [])->assertStatus(200);
        $this->post('api/auth/logout?token=' . $token, [], [])->assertStatus(401);
    }


    public function testLoginSuccessfully()
    {
        $this->post('api/auth/login', [
            'email' => 'test@gmail.com',
            'password' => '123456'
        ])->assertJson([
            'status' => 'ok'
        ])->assertJsonStructure([
            'status',
            'token',
            'expires_in'
        ])->isOk();
    }

    public function testLoginWithReturnsWrongCredentialsError()
    {
        $this->post('api/auth/login', [
            'email' => 'unknown@gmail.com',
            'password' => '123456'
        ])->assertJsonStructure([
            'error'
        ])->assertStatus(403);
    }

    public function testLoginWithReturnsValidationError()
    {
        $this->post('api/auth/login', [
            'email' => 'test@gmail.com'
        ])->assertJsonStructure([
            'error'
        ])->assertStatus(422);
    }
}

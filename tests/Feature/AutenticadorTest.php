<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;
use Laravel\Passport\Passport;

class AutenticadorTest extends TestCase
{
    /** @test */
    public function registry_validation_errors()
    {
        $data = [
            'name' => 'teste01',
            'email' => 'teste01@teste01.com',
            'password' => '789652478',
            'password_confirmation' => '789652478'

        ];
        $this->json('post', 'api/auth/registro', $data)->assertStatus(201)->getContent();

    }

    /** @test */
    public function login_validation_errors()
    {
        $data = [
            'email' => 'teste01@teste01.com',
            'password' => '789652478'
        ];
        $this->json('post', 'api/auth/login', $data)->assertStatus(200)->getContent();
    }

    /** @test */
    public function logout_validation_errors()
    {
        $this->json('post', 'api/auth/logout')->assertStatus(401)->getContent();
    }
}

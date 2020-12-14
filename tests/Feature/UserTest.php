<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use Tests\TestCase;

class UserTest extends TestCase
{
    use DatabaseTransactions;

    const ADMIN_EMAIL = 'veus@veus.com';

    /** @test */
    public function register_admin()
    {
        $data = [
            'name' => 'veus',
            'email' => self::ADMIN_EMAIL,
            'password' => '123456789',
            'password_confirmation' => '123456789'
        ];

        $this->json('post', 'api/auth/register', $data)->assertStatus(201);
    }

    /** @test */
    public function check_login_admin()
    {
        $data = [
            'email' => 'bruno.dn.fernandes@gmail.com',
            'password' => '123456789'
        ];

        $response = $this->json('post', 'api/auth/login', $data)->assertStatus(200);
        $this->assertArrayHasKey('token', $response->json());
    }

    /** @test */
    public function check_details_admin()
    {
        Passport::actingAs(User::where('email', 'bruno.dn.fernandes@gmail.com')->first());

        $response = $this->json('get', 'api/v1/user')->assertStatus(200);
        $this->assertArrayHasKey('success', $response->json());
    }

    /** @test */
    public function check_logout_admin()
    {
        Passport::actingAs(User::where('email', 'bruno.dn.fernandes@gmail.com')->first());

        $response = $this->json('post', 'api/auth/logout')->assertStatus(200);
        $this->assertArrayHasKey('msg', $response->json());
    }
}

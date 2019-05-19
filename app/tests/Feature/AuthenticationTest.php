<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use DB;


class AuthenticationTest extends TestCase
{

    private $userTest = [
                'name' => 'Test',
                'email' => 'test@test.com',
                'password' => 'test1234',
                'c_password' => 'test1234',
            ];   

    public function testRegister()
    {
        User::where('email',$this->userTest['email'])->delete();
       
        $response = $this->json('POST', '/api/v1/register', $this->userTest);
        
        $response->assertStatus(200)
                    ->assertJson([
                        'success' => true,
                    ])
                    ->assertJsonStructure([
                        'success',
                        'data' => ['token', 'name'],
                        'message'
                    ]);
       
    }

    public function testRegisterEmptyName()
    {       
        $this->userTest['name'] = "";

        $response = $this->json('POST', '/api/v1/register', $this->userTest);

        $response->assertStatus(404)
                    ->assertJson([
                        'success' => false,
                        'message' => 'Validation Error.'
                    ])
                    ->assertJsonStructure([
                        'success',
                        'data'  => ['email'],
                        'message'
                    ]);
       
    }

    public function testRegisterEmptyEmail()
    {       
        $this->userTest['email'] = "";

        $response = $this->json('POST', '/api/v1/register', $this->userTest);

        $response->assertStatus(404)
                    ->assertJson([
                        'success' => false,
                        'message' => 'Validation Error.'
                    ])
                    ->assertJsonStructure([
                        'success',
                        'data'  => ['email'],
                        'message'
                    ]);
       
    }

    public function testRegisterEmptyPassword()
    {       
        $this->userTest['password'] = "";

        $response = $this->json('POST', '/api/v1/register', $this->userTest);

        $response->assertStatus(404)
                    ->assertJson([
                        'success' => false,
                        'message' => 'Validation Error.'
                    ])
                    ->assertJsonStructure([
                        'success',
                        'data'  => ['email'],
                        'message'
                    ]);
       
    }

    public function testRegisterEmptyConfirmPassword()
    {       
        $this->userTest['c_password'] = "";

        $response = $this->json('POST', '/api/v1/register', $this->userTest);

        $response->assertStatus(404)
                    ->assertJson([
                        'success' => false,
                        'message' => 'Validation Error.'
                    ])
                    ->assertJsonStructure([
                        'success',
                        'data'  => ['email'],
                        'message'
                    ]);
       
    }

    public function testRegisterEmptyConfirmPasswordIsTheSamePassword()
    {       
        $this->userTest['password'] = "123";
        $this->userTest['c_password'] = "1234";

        $response = $this->json('POST', '/api/v1/register', $this->userTest);

        $response->assertStatus(404)
                    ->assertJson([
                        'success' => false,
                        'message' => 'Validation Error.'
                    ])
                    ->assertJsonStructure([
                        'success',
                        'data'  => ['email'],
                        'message'
                    ]);
       
    }
    
    public function testRegisterDuplicate()
    {       
        $response = $this->json('POST', '/api/v1/register', $this->userTest);

        $response->assertStatus(404)
                    ->assertJson([
                        'success' => false,
                        'message' => 'Validation Error.'
                    ])
                    ->assertJsonStructure([
                        'success',
                        'data'  => ['email'],
                        'message'
                    ]);
       
        User::where('email',$this->userTest['email'])->delete();
    }

    public function testLogin()
    {       
        $user = User::create([
            'name' => $this->userTest['name'],
            'email'=> $this->userTest['email'],
            'password' => bcrypt($this->userTest['password'])
        ]);

        $client = DB::table('oauth_clients')->where('id', 2)->first();
 
        $response = $this->json('POST', '/oauth/token',[
            'username' => $this->userTest['email'],
            'password' => $this->userTest['password'],
            'grant_type' => 'password',
            'client_id' => 2,
            'client_secret' => $client->secret
        ]);

        $response->assertStatus(200);

        $this->assertArrayHasKey('access_token',$response->json());

        User::where('email',$this->userTest['email'])->delete();
    }

    public function testLoginFail()
    {       

        $client = DB::table('oauth_clients')->where('id', 2)->first();
 
        $response = $this->json('POST', '/oauth/token',[
            'username' => $this->userTest['email'],
            'password' => 'outrasenha',
            'grant_type' => 'password',
            'client_id' => 2,
            'client_secret' => $client->secret
        ]);


        $response->assertStatus(401)
                    ->assertJson([
                        'error' => 'invalid_credentials',
                        'error_description' => 'The user credentials were incorrect.',
                        'message' => 'The user credentials were incorrect.',
                    ])
                    ->assertJsonStructure([
                        'error',
                        'error_description',
                        'message'
                    ]);

    }

    
}

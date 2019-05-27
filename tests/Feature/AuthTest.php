<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthTest extends TestCase
{

    /**
     * @test
     * Test registration
     */
    public function testRegister(){

        //User's data
        $data = [
            'email' => 'teste@gmail.com',
            'name' => 'Teste',
            'password' => 'teste1234',
            'password_confirmation' => 'teste1234',
        ];

        //Send post request
        $response = $this->json('POST',route('api.register'),$data);
        //Assert it was successful
        $response->assertStatus(200);
        //Assert we received a token
        $this->assertArrayHasKey('token',$response->json());
        //Delete data
        User::where('email','teste@gmail.com')->delete();
    }

    /**
     * @test
     * Test login
     */
    public function testLogin()
    {
        
        //Create user
        User::create([
            'email' => 'teste@gmail.com',
            'name' => 'Teste',
            'password' => bcrypt('teste1234'),
        ]);

        //attempt login
        $response = $this->json('POST',route('api.authenticate'),[
            'email' => 'teste@gmail.com',
            'password' => 'teste1234',
        ]);
        //Assert it was successful and a token was received
        $response->assertStatus(200);
        $this->assertArrayHasKey('token',$response->json());
        //Delete the user
        User::where('email','teste@gmail.com')->delete();
    }


}
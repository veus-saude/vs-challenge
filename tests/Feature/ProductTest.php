<?php

namespace Tests\Feature;

use App\Http\Model\Product\ProductModel;
use App\User;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class ProductTest extends TestCase
{

    protected $user;

    /**
     * Create user and get token
     * @return string
     */
    protected function authenticate(){
        $user = User::create([
            'email' => 'teste@gmail.com',
            'name' => 'Teste',
            'password' => bcrypt('teste1234'),
        ]);
        $this->user = $user;
        $token = JWTAuth::fromUser($user);
        return $token;
    }


    public function testSearch(){
        //Authenticate and attach recipe to user
        $token = $this->authenticate();

        //call route and assert response
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $token,
        ])->json('GET',route('product.search'),['product_id'=>1]);
        $response->assertStatus(200);
    }
}
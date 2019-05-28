<?php

namespace Tests\Feature;

use App\Http\Model\Brand\BrandModel;
use App\Http\Model\Product\ProductModel;
use App\User;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tymon\JWTAuth\Facades\JWTAuth;

class ProductTest extends TestCase
{

    use RefreshDatabase;

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

    public function testCreate()
    {
        //create brand
        $brand=BrandModel::create([
            'brand_name' => 'Farmaceuticos São Paulo'
        ]);
        
        //get Bearer token
        $token = $this->authenticate();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $token,
        ])->json('POST',route('add'),[
            'product_name' => 'Seringa Tipo Pistola',
            'brand_id' => $brand->brand_id,
            'product_price' => 110.20,
            'product_qty'   => 10
        ]);
        //if 302 means that the page redirects successfully to the edit page
        $response->assertStatus(302);
    }

    public function testUpdate(){
        //create brand
        $brand=BrandModel::create([
            'brand_name' => 'Farmaceuticos Manaus'
        ]);
        //create product
        $product = ProductModel::create([
            'product_name' => 'Antiinflamatorio Nimesulida',
            'brand_id' => $brand->brand_id,
            'product_price' => 110.20,
            'product_qty'   => 10
        ]);
        //get Bearer token
        $token = $this->authenticate();
        //call route and assert response
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $token,
        ])->json('POST',route('edit',['product_id' => $product->product_id]),[
            'product_name' => 'Antiinflamatorio Ibupofreno',
        ]);
        //if 302 means that the page redirects successfully to the edit page
        $response->assertStatus(302);

        //get product
        $productUpdated=ProductModel::find($product->product_id);
        //Assert title is the new title
        $this->assertEquals('Antiinflamatorio Ibupofreno',$productUpdated->product_name);
    }

    public function testDelete(){
        //create brand
        $brand=BrandModel::create([
            'brand_name' => 'Farmaceuticos Manaus'
        ]);
        //create product
        $product = ProductModel::create([
            'product_name' => 'Antiinflamatorio Nimesulida',
            'brand_id' => $brand->brand_id,
            'product_price' => 110.20,
            'product_qty'   => 10
        ]);
        $token = $this->authenticate();
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $token,
        ])->json('POST',route('delete',['product_id' => $product->product_id]));
        //if 302 means that the page redirects successfully to the home
        $response->assertStatus(302);
        //get product
        $productDeleted=ProductModel::find($product->product_id);
        //Assert there are no recipes
        $this->assertEquals(null,$productDeleted);
    }

    public function testSearch(){

        //create brand
        $brand=BrandModel::create([
            'brand_name' => 'Farmaceuticos Manaus'
        ]);

        $product = ProductModel::create([
            'product_name' => 'Antiinflamatorio Nimesulida',
            'brand_id' => $brand->brand_id,
            'product_price' => 110.20,
            'product_qty'   => 10
        ]);

        $product = ProductModel::create([
            'product_name' => 'Antibiotico Bezetacil',
            'brand_id' => $brand->brand_id,
            'product_price' => 220.20,
            'product_qty'   => 10
        ]);

        $product = ProductModel::create([
            'product_name' => 'Antiinflamatorio Ibupofreno',
            'brand_id' => $brand->brand_id,
            'product_price' => 110.20,
            'product_qty'   => 2
        ]);

        $product = ProductModel::create([
            'product_name' => 'Antibiotico Clavulato',
            'brand_id' => $brand->brand_id,
            'product_price' => 220.20,
            'product_qty'   => 2
        ]);

        //Authenticate and attach recipe to user
        $token = $this->authenticate();

        //call route and assert response
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $token,
        ])->json('GET',route('product.v1.search'),['price_more_than'=>1,'order_desc'=>'product_id']);
        $response->assertStatus(200);
    }
}
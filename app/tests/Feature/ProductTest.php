<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Product;
use App\User;
use DB;
use App\Brand;

class ProductTest extends TestCase
{

    private $userTest = [
                            'name' => 'Test',
                            'email' => 'test@test.com',
                            'password' => 'test1234',
                            'c_password' => 'test1234',
                        ];  
    
    private $productTest = [
                            'name' => 'Product-Test',
                            'brand_id' => 1,
                            'price' => '9.99',
                            'quantity' => '9999'
                        ];
    
    private $brandTest = [
                            'name' => 'Brand-Test'
                        ];
    

    public function authenticate()
    {          
        User::where('email',$this->userTest['email'])->delete();
       
        $response = $this->json('POST', '/api/v1/register', $this->userTest);
 
        return(json_decode($response->getContent())->data->token );
    }

    public function testProductCreate()
    {
        Product::where('name', $this->productTest['name'])->delete();

        Brand::where('name', $this->brandTest['name'])->delete();

        $this->productTest['brand_id'] = Brand::create($this->brandTest)->id;

        $authorization = $this->authenticate();
        
        $this->withHeaders([
                            'Authorization' => 'Bearer '. $authorization,
                            'Accept' => 'application/json'
                        ])
                        ->json('POST', '/api/v1/products', $this->productTest)
                        ->assertStatus(200)
                        ->assertJson([
                            'success' => true,
                            'data' => $this->productTest
                        ])
                        ->assertJsonStructure([
                            'success',
                            'data' => ['id', 'name', 'brand_id', 'price', 'quantity', 'created_at', 'updated_at'],
                            'message'
                        ]);

    }

    public function testProductById()
    {
        Product::where('name', $this->productTest['name'])->delete();
        Brand::where('name', $this->brandTest['name'])->delete();

        $this->productTest['brand_id'] = Brand::create($this->brandTest)->id;

        $product = Product::create($this->productTest);

        $authorization = $this->authenticate();
        
        $this->withHeaders([
                            'Authorization' => 'Bearer '. $authorization,
                            'Accept' => 'application/json'
                        ])
                        ->json('GET', '/api/v1/products/'.$product->id, $this->productTest)
                        ->assertStatus(200)
                        ->assertJson([
                            'success' => true,
                            'data' => $this->productTest
                        ])
                        ->assertJsonStructure([
                            'success',
                            'data' => ['id', 'name', 'brand_id', 'price', 'quantity', 'created_at', 'updated_at'],
                            'message'
                        ]);

    }

    public function testProductByIdNotFound()
    {

        $authorization = $this->authenticate();
        
        $this->withHeaders([
                            'Authorization' => 'Bearer '. $authorization,
                            'Accept' => 'application/json'
                        ])
                        ->json('GET', '/api/v1/products/0')
                        ->assertStatus(404)
                        ->assertJson([
                            'success' => false,
                            'message' => 'Product not found'
                        ])
                        ->assertJsonStructure([
                            'success',
                            'message'
                        ]);

    }

    public function testProductUpdate()
    {
        Product::where('name', $this->productTest['name'])->delete();

        Brand::where('name', $this->brandTest['name'])->delete();

        $brand_id = Brand::create($this->brandTest)->id;

        $this->productTest['brand_id'] = $brand_id;

        $product = Product::create($this->productTest);

        $authorization = $this->authenticate();

        $productTestUpdate = [
                                'name' => 'Product Test Updated',
                                'brand_id' => $brand_id,
                                'price' => '19.99',
                                'quantity' => '999'
                            ];
        
        $this->withHeaders([
                            'Authorization' => 'Bearer '. $authorization,
                            'Accept' => 'application/json'
                        ])
                        ->json('PUT', '/api/v1/products/'.$product->id, $productTestUpdate)
                        ->assertStatus(200)
                        ->assertJson([
                            'success' => true,
                            'data' => $productTestUpdate,
                            'message' => 'Product updated successfully.'
                        ])
                        ->assertJsonStructure([
                            'success',
                            'data' => ['id', 'name', 'brand_id', 'price', 'quantity', 'created_at', 'updated_at'],
                            'message'
                        ]);

        Product::where('name', $productTestUpdate['name'])->delete();

    }

    public function testProductUpdateNotFound()
    {
        $authorization = $this->authenticate();
        
        $this->withHeaders([
                            'Authorization' => 'Bearer '. $authorization,
                            'Accept' => 'application/json'
                        ])
                        ->json('PUT', '/api/v1/products/0')
                        ->assertStatus(404)
                        ->assertJson([
                            'success' => false,
                            'message' => 'Entry for Product not found'
                        ])
                        ->assertJsonStructure([
                            'success',
                            'message'
                        ]);

    }

    public function testProductDelete()
    {
        Product::where('name', $this->productTest['name'])->delete();

        Brand::where('name', $this->brandTest['name'])->delete();

        $this->productTest['brand_id'] = Brand::create($this->brandTest)->id;

        $product = Product::create($this->productTest);

        $authorization = $this->authenticate();
        
        $this->withHeaders([
                            'Authorization' => 'Bearer '. $authorization,
                            'Accept' => 'application/json'
                        ])
                        ->json('DELETE', '/api/v1/products/'.$product->id)
                        ->assertStatus(200)
                        ->assertJson([
                            'success' => true,
                            'data' => $this->productTest,
                            'message' => 'Product deleted successfully.'
                        ])
                        ->assertJsonStructure([
                            'success',
                            'data' => ['id', 'name', 'brand_id', 'price', 'quantity', 'created_at', 'updated_at'],
                            'message'
                        ]);

    }

    public function testProductDeleteNotFound()
    {

        $authorization = $this->authenticate();
        
        $this->withHeaders([
                            'Authorization' => 'Bearer '. $authorization,
                            'Accept' => 'application/json'
                        ])
                        ->json('DELETE', '/api/v1/products/0')
                        ->assertStatus(404)
                        ->assertJson([
                            'success' => false,
                            'message' => 'Entry for Product not found'
                        ])
                        ->assertJsonStructure([
                            'success',
                            'message'
                        ]);

    }

    public function testProductAll()
    {
        Product::where('name', $this->productTest['name'])->delete();

        Brand::where('name', $this->brandTest['name'])->delete();

        $this->productTest['brand_id'] = Brand::create($this->brandTest)->id;

        $product = Product::create($this->productTest);
        
        $authorization = $this->authenticate();
        
        $this->withHeaders([
                            'Authorization' => 'Bearer '. $authorization,
                            'Accept' => 'application/json'
                        ])
                        ->json('GET', '/api/v1/products')
                        ->assertStatus(200)
                        ->assertJson([
                            'success' => true,
                            'message' => 'Products retrieved successfully.'
                        ])
                        ->assertJsonStructure([
                            'success',
                            'data',
                            'message'
                        ]);

    }

    public function testProductWithFilter()
    {
        Product::where('name', $this->productTest['name'])->delete();

        Brand::where('name', $this->brandTest['name'])->delete();

        $this->productTest['brand_id'] = Brand::create($this->brandTest)->id;

        $product = Product::create($this->productTest);
        
        $authorization = $this->authenticate();
        
        $response = $this->withHeaders([
                            'Authorization' => 'Bearer '. $authorization,
                            'Accept' => 'application/json'
                        ])
                        ->json('GET', '/api/v1/products?q='.$product->name)
                        ->assertStatus(200)
                        ->assertJson([
                            'success' => true,
                            'message' => 'Products retrieved successfully.'
                        ])
                        ->assertJsonStructure([
                            'success',
                            'data',
                            'message'
                        ]);

    }

    public function testProductWithFilterAndFieldBrand()
    {
        Product::where('name', $this->productTest['name'])->delete();

        Brand::where('name', $this->brandTest['name'])->delete();

        $this->productTest['brand_id'] = Brand::create($this->brandTest)->id;

        $product = Product::create($this->productTest);
        
        $authorization = $this->authenticate();
        
        $this->withHeaders([
                            'Authorization' => 'Bearer '. $authorization,
                            'Accept' => 'application/json'
                        ])
                        ->json('GET', '/api/v1/products?q='.$product->name.'&filter=BRAND:'.$product->brand->name)
                        ->assertStatus(200)
                        ->assertJson([
                            'success' => true,
                            'message' => 'Products retrieved successfully.'
                        ])
                        ->assertJsonStructure([
                            'success',
                            'data',
                            'message'
                        ]);

    }

    public function testProductWithFilterAndFieldPrice()
    {
        Product::where('name', $this->productTest['name'])->delete();

        Brand::where('name', $this->brandTest['name'])->delete();

        $this->productTest['brand_id'] = Brand::create($this->brandTest)->id;

        $product = Product::create($this->productTest);
        
        $authorization = $this->authenticate();
        
        $this->withHeaders([
                            'Authorization' => 'Bearer '. $authorization,
                            'Accept' => 'application/json'
                        ])
                        ->json('GET', '/api/v1/products?q='.$product->name.'&filter=PRICE:'.$product->price)
                        ->assertStatus(200)
                        ->assertJson([
                            'success' => true,
                            'message' => 'Products retrieved successfully.'
                        ])
                        ->assertJsonStructure([
                            'success',
                            'data',
                            'message'
                        ]);

    }

    public function testProductWithFilterAndFieldQuantity()
    {
        Product::where('name', $this->productTest['name'])->delete();

        Brand::where('name', $this->brandTest['name'])->delete();

        $this->productTest['brand_id'] = Brand::create($this->brandTest)->id;

        $product = Product::create($this->productTest);
        
        $authorization = $this->authenticate();
        
        $this->withHeaders([
                            'Authorization' => 'Bearer '. $authorization,
                            'Accept' => 'application/json'
                        ])
                        ->json('GET', '/api/v1/products?q='.$product->name.'&filter=QUANTITY:'.$product->quantity)
                        ->assertStatus(200)
                        ->assertJson([
                            'success' => true,
                            'message' => 'Products retrieved successfully.'
                        ])
                        ->assertJsonStructure([
                            'success',
                            'data',
                            'message'
                        ]);

    }
}

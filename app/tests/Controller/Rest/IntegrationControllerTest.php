<?php

namespace App\Controller\Rest;

use Symfony\Component\HttpClient\HttpClient;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Response;

class IntegrationControllerTest extends TestCase
{
    /**
     * Undocumented variable
     *
     * @var String;
     */
    private $token;

    /**
     *
     * @var HttpClient
     */
    private $httpdClient;


    public function setUp()
    {
       $this->token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VybmFtZSI6InVzdWFyaW8ifQ.-m3IoKses9ullRykqBJ30M2NGquYFKWyvCDV24LuNJc";
        $this->httpdClient = HttpClient::create();
    }

    public function test_registerUser_ok()
    {
        /**
         * @var ResponseInterface
         */
        $response = $this->httpdClient->request(
            'POST',
            'http://host.docker.internal:8080/security/login',
            [
                'headers' => ['Content-Type' => 'text/json'],
                'json' => ['username' => 'usuario', 'password' => '123456']
            ]
        );

        $content = $response->toArray();

        $this->assertEquals($this->token, $content['access_token']);
        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
        $this->assertEquals("application/json", $response->getHeaders()['content-type'][0]);
    }

    public function test_get_products_ok()
    {

        $response = $this->httpdClient->request('GET', 'http://host.docker.internal:8080/api/v1.1/products?page=1&size=2', [
            'headers' => ['Content-Type' => 'text/json'],
            'auth_bearer' => $this->token
        ]);

        $arrayProducts = $response->toArray();
        $this->assertEquals(count($arrayProducts['data']), 2);
        $this->assertEquals(Response::HTTP_PARTIAL_CONTENT, $response->getStatusCode());
        $this->assertEquals("application/json", $response->getHeaders()['content-type'][0]);
    }

    public function test_get_products_page_not_found()
    {
        $response = $this->httpdClient->request('GET', 'http://host.docker.internal:8080/api/v1.1/products?page=200000&size=10', [
            'headers' => ['Content-Type' => 'text/json'],
            'auth_bearer' => $this->token
        ]);

        $arrayProducts = $response->toArray();
        $this->assertEquals(count($arrayProducts['data']), 0);
        $this->assertEquals(Response::HTTP_PARTIAL_CONTENT, $response->getStatusCode());
        $this->assertEquals("application/json", $response->getHeaders()['content-type'][0]);
    }
  
    public function test_create_product_request_ok(){

        $productArray = ["name"=>"ampola","brand"=>"baigon","amount"=> 60,"price"=> 200];

        $response = $this->httpdClient->request('POST', 'http://host.docker.internal:8080/api/v1.1/products', [
            'headers' => ['Content-Type' => 'text/json'],
            'auth_bearer' => $this->token, 
            'json' => $productArray
        ]);

        $content = $response->toArray();

        $id = $content['id'];
        unset($content['id']);

        $this->assertEquals($productArray, $content);
        $this->assertEquals(Response::HTTP_CREATED, $response->getStatusCode());
        $this->assertEquals("application/json", $response->getHeaders()['content-type'][0]);
        return $id;
    }

    
     /**
     * @depends test_create_product_request_ok
     */
    public function test_get_product_created_id_request_ok($id){

        $response = $this->httpdClient->request('GET', 'http://host.docker.internal:8080/api/v1.1/products/'.$id, [
            'headers' => ['Content-Type' => 'text/json'],
            'auth_bearer' => $this->token
        ]); 

        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
        $this->assertEquals("application/json", $response->getHeaders()['content-type'][0]);
        
        return $id;
    }

     /**
     * @depends test_get_product_created_id_request_ok
     */
    public function test_put_product_by_id_request_ok($id){
        $response = $this->httpdClient->request('PUT', 'http://host.docker.internal:8080/api/v1.1/products/'.$id, [
            'headers' => ['Content-Type' => 'text/json'],
            'auth_bearer' => $this->token
        ]); 

 
        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
        $this->assertEquals("application/json", $response->getHeaders()['content-type'][0]);

        return $id;
    }
    /**
     * @depends test_put_product_by_id_request_ok
     */
    public function test_delete_product_by_id_request_ok($id){
        $response = $this->httpdClient->request('DELETE', 'http://host.docker.internal:8080/api/v1.1/products/'.$id, [
            'headers' => ['Content-Type' => 'text/json'],
            'auth_bearer' => $this->token
        ]); 

        $content = $response->getContent();
        $this->assertEmpty($content);
        $this->assertEquals(Response::HTTP_NO_CONTENT, $response->getStatusCode());
        $this->assertEquals("text/html; charset=UTF-8", $response->getHeaders()['content-type'][0]);

        return $id;
    }

    public function tearDown()
    {
        $this->httpdClient = null;
    }
}

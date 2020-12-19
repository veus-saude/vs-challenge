<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoutesAPITest extends TestCase
{
   /** @test */
    public function route_visit_api_login()
    {
        $this->post(route("auth.login"))
            ->assertStatus(200);
    }

    /** @test */
    public function route_visit_api_logout()
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => env("APP_URL")."/api/auth/login",
            CURLOPT_RETURNTRANSFER       => true,
            CURLOPT_ENCODING             => "",
            CURLOPT_MAXREDIRS            => 10,
            CURLOPT_TIMEOUT              => 0,
            CURLOPT_FOLLOWLOCATION       => true,
            CURLOPT_HTTP_VERSION         => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST        => "POST",
            CURLOPT_POSTFIELDS => array(
                'cpf'           => '11111111111',
                'password'      => 'cnsa@020459'
            )
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $return = json_decode($response, true);
        $token = isset($return["status"]) && $return["status"]==="success" ? $return["data"]["access_token"] : "";
        $data = [
            "_token" => csrf_token()
        ];
        $headers = [
            "content-type"    => "application/json",
            "Authorization"   => "Bearer $token"
        ];
        $this->post(route("auth.logout"), $data, $headers)
            ->assertStatus(200);
    }

    /** @test */
    public function route_visit_api_refresh_token()
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => env("APP_URL")."/api/auth/login",
            CURLOPT_RETURNTRANSFER       => true,
            CURLOPT_ENCODING             => "",
            CURLOPT_MAXREDIRS            => 10,
            CURLOPT_TIMEOUT              => 0,
            CURLOPT_FOLLOWLOCATION       => true,
            CURLOPT_HTTP_VERSION         => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST        => "POST",
            CURLOPT_POSTFIELDS => array(
                'cpf'           => '11111111111',
                'password'      => 'cnsa@020459'
            )
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $return = json_decode($response, true);
        $token = isset($return["status"]) && $return["status"]==="success" ? $return["data"]["access_token"] : "";
        $data = [
            "_token" => csrf_token()
        ];
        $headers = [
            "content-type"    => "application/json",
            "Authorization"   => "Bearer $token"
        ];
        $this->post(route("auth.refresh"), $data, $headers)
            ->assertStatus(200);
    }

    /** @test */
    public function route_visit_api_list_users()
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => env("APP_URL")."/api/auth/login",
            CURLOPT_RETURNTRANSFER       => true,
            CURLOPT_ENCODING             => "",
            CURLOPT_MAXREDIRS            => 10,
            CURLOPT_TIMEOUT              => 0,
            CURLOPT_FOLLOWLOCATION       => true,
            CURLOPT_HTTP_VERSION         => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST        => "POST",
            CURLOPT_POSTFIELDS => array(
                'cpf'           => '11111111111',
                'password'      => 'cnsa@020459'
            )
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $return = json_decode($response, true);
        $token = isset($return["status"]) && $return["status"]==="success" ? $return["data"]["access_token"] : "";
        $headers = [
            "content-type"    => "application/json",
            "Authorization"   => "Bearer $token"
        ];
        $this->get(route("user.index"), $headers)
            ->assertStatus(200);
    }

    /** @test */
    public function route_visit_api_store_users()
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => env("APP_URL")."/api/auth/login",
            CURLOPT_RETURNTRANSFER       => true,
            CURLOPT_ENCODING             => "",
            CURLOPT_MAXREDIRS            => 10,
            CURLOPT_TIMEOUT              => 0,
            CURLOPT_FOLLOWLOCATION       => true,
            CURLOPT_HTTP_VERSION         => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST        => "POST",
            CURLOPT_POSTFIELDS => array(
                'cpf'           => '11111111111',
                'password'      => 'cnsa@020459'
            )
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $return = json_decode($response, true);
        $token = isset($return["status"]) && $return["status"]==="success" ? $return["data"]["access_token"] : "";
        $data = [
            "_token"                => csrf_token(),
            'first_name'            => 'Primeiro Nome',
            'last_name'             => 'Segundo Nome',
            'email'                 => 'testeunit@gmail.com',
            'cpf'                   => '96969696969',
            'password'              => '1234',
            'password_confirmation' => '1234',
            'terms'                 => 'on',
            'use_api'               => '1'
        ];
        $headers = [
            "content-type"    => "application/json",
            "Authorization"   => "Bearer $token"
        ];
        $this->post(route("user.store"), $data, $headers)
            ->assertStatus(200);
    }

    /** @test */
    public function route_visit_api_list_movies()
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => env("APP_URL")."/api/auth/login",
            CURLOPT_RETURNTRANSFER       => true,
            CURLOPT_ENCODING             => "",
            CURLOPT_MAXREDIRS            => 10,
            CURLOPT_TIMEOUT              => 0,
            CURLOPT_FOLLOWLOCATION       => true,
            CURLOPT_HTTP_VERSION         => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST        => "POST",
            CURLOPT_POSTFIELDS => array(
                'cpf'           => '11111111111',
                'password'      => 'cnsa@020459'
            )
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $return = json_decode($response, true);
        $token = isset($return["status"]) && $return["status"]==="success" ? $return["data"]["access_token"] : "";
        $headers = [
            "content-type"    => "application/json",
            "Authorization"   => "Bearer $token"
        ];
        $this->get(route("movie.index"), $headers)
            ->assertStatus(200);
    }

    /** @test */
    public function route_visit_api_favorite_movies()
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => env("APP_URL")."/api/auth/login",
            CURLOPT_RETURNTRANSFER       => true,
            CURLOPT_ENCODING             => "",
            CURLOPT_MAXREDIRS            => 10,
            CURLOPT_TIMEOUT              => 0,
            CURLOPT_FOLLOWLOCATION       => true,
            CURLOPT_HTTP_VERSION         => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST        => "POST",
            CURLOPT_POSTFIELDS => array(
                'cpf'           => '11111111111',
                'password'      => 'cnsa@020459'
            )
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $return = json_decode($response, true);
        $token = isset($return["status"]) && $return["status"]==="success" ? $return["data"]["access_token"] : "";
        $headers = [
            "content-type"    => "application/json",
            "Authorization"   => "Bearer $token"
        ];
        $this->get(route("movie.favorite", ["movie_id"=>1]), $headers)
            ->assertStatus(200);
    }

    /** @test */
    public function route_visit_api_list_favorites_movies()
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => env("APP_URL")."/api/auth/login",
            CURLOPT_RETURNTRANSFER       => true,
            CURLOPT_ENCODING             => "",
            CURLOPT_MAXREDIRS            => 10,
            CURLOPT_TIMEOUT              => 0,
            CURLOPT_FOLLOWLOCATION       => true,
            CURLOPT_HTTP_VERSION         => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST        => "POST",
            CURLOPT_POSTFIELDS => array(
                'cpf'           => '11111111111',
                'password'      => 'cnsa@020459'
            )
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $return = json_decode($response, true);
        $token = isset($return["status"]) && $return["status"]==="success" ? $return["data"]["access_token"] : "";
        $headers = [
            "content-type"    => "application/json",
            "Authorization"   => "Bearer $token"
        ];
        $this->get(route("movie.listFavorite"), $headers)
            ->assertStatus(200);
    }

    /** @test */
    public function route_visit_api_delete_favorite_movies()
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => env("APP_URL")."/api/auth/login",
            CURLOPT_RETURNTRANSFER       => true,
            CURLOPT_ENCODING             => "",
            CURLOPT_MAXREDIRS            => 10,
            CURLOPT_TIMEOUT              => 0,
            CURLOPT_FOLLOWLOCATION       => true,
            CURLOPT_HTTP_VERSION         => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST        => "POST",
            CURLOPT_POSTFIELDS => array(
                'cpf'           => '11111111111',
                'password'      => 'cnsa@020459'
            )
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $return = json_decode($response, true);
        $token = isset($return["status"]) && $return["status"]==="success" ? $return["data"]["access_token"] : "";
        $headers = [
            "content-type"    => "application/json",
            "Authorization"   => "Bearer $token"
        ];
        $this->get(route("movie.deleteFavorite", ["movie_id"=>1]), $headers)
            ->assertStatus(200);
    }
}

<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;
use Laravel\Passport\Passport;

class ProductTest extends TestCase
{
    /** @test */
    public function create_produtos_validation_errors()
    {
        Passport::actingAs(User::where('id', 1)->first());
        $data = [
            'nome' => 'produto02',
            'marca' => 'Teste',
            'preco' => $this->faker->randomFloat(2, 2, 100),
            'quantidade' => $this->faker->randomNumber()
        ];
        $this->json('post', 'api/produtos', $data)->assertStatus(201)->getContent();

        $this->assertDatabaseHas('produtos', $data);
    }

    /** @test */
    public function update_produtos_validation_errors()
    {
        Passport::actingAs(User::where('id', 1)->first());
        $id=1;
        $data = [
        
            'marca' => 'teste'
            
        ];
        $this->json('put', 'api/produtos/'.$id, $data)->assertStatus(200)->getContent();

        $this->assertDatabaseHas('produtos', $data);
    }

    

    /** @test */
    public function index_produtos_returns_a_view()
    {
        // q=seringtes&filter=brand:BUNZL
        $this->json('get', 'api/produtos?q=produto02&filter=marca:teste')->assertStatus(200)->getContent();
    }

    /** @test */
    public function show_produtos_returns_a_view()
    {
        Passport::actingAs(User::where('id', 1)->first());

        $id = 1;

        $this->json('get', 'api/produtos/' . $id)->assertStatus(200)->getContent();
    }

    /** @test */
    public function delete_produtos_validation_errors()
    {
        Passport::actingAs(User::where('id', 1)->first());

        $id=1;

        $this->json('delete', 'api/produtos/'.$id)->assertStatus(302)->getContent();
        
    }

}

<?php

namespace Tests\Feature;

use App\Models\Marca;
use App\Models\Produto;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use Tests\TestCase;

class ProductTest extends TestCase
{
    const ADMIN_EMAIL = 'bruno.dn.fernandes@gmail.com';

    /** @test */
    public function admin_can_create_product()
    {
        Passport::actingAs(User::where('email', self::ADMIN_EMAIL)->first());
        $data = [
            'nome' => $this->faker->name,
            'brand' => 'Teste',
            'preco' => $this->faker->randomFloat(2, 2, 100),
            'qtd_estoque' => $this->faker->randomNumber()
        ];
        $this->json('post', 'api/v1/products', $data)->assertStatus(201)->getContent();

        $this->assertDatabaseHas('produtos', $data);
    }

    /** @test */
    public function admin_can_update_product()
    {
        Passport::actingAs(User::where('email', self::ADMIN_EMAIL)->first());
        $produto = Produto::select('id')->inRandomOrder()->first();

        $nome_alterado = $this->faker->name;

        $data = [
            'nome' => $nome_alterado,
        ];

        $this->json('put', 'api/v1/products/' . $produto->id, $data)->assertStatus(200)->getContent();

        $this->assertDatabaseHas('produtos', $data);
    }

    /** @test */
    public function admin_can_show_product()
    {
        Passport::actingAs(User::where('email', self::ADMIN_EMAIL)->first());
        $produto = Produto::inRandomOrder()->first();

        $this->json('get', 'api/v1/products/' . $produto->id)->assertStatus(200);

        $this->assertDatabaseHas('produtos', ['nome'=>$produto->nome]);
    }

    /** @test */
    public function check_user_filter_product()
    {
        $this->json('get', 'api/v1/products/?q=seringa&filter=brand:BUNZL')->assertStatus(200);
    }

    /** @test */
    public function admin_can_delete_product()
    {
        Passport::actingAs(User::where('email', self::ADMIN_EMAIL)->first());
        $produto = Produto::select('id')->inRandomOrder()->first();

        $this->json('delete', 'api/v1/products/' . $produto->id)->assertStatus(204);
    }
}

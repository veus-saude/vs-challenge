<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class BrandTest extends TestCase
{
    use DatabaseTransactions;

    // Faz login de novo, não dá pra gravar um cache em TestCase
    // @see UserTest::test_auth_generate_token
    public function test_auth_login_again()
    {
        $response = $this->post('/v1/auth/user', [
            'email'     => 'lucas.codemax@gmail.com',
            'password'  => 'himura08'
        ]);

        // Verifica se retornou o Token que será usado em outros endpoints que requerer autenticação
        $response->seeJsonStructure(['token', 'user']);
        //define('BEARER_TOKEN', $response->response->original['token']);

        if(!defined('BEARER_TOKEN')) define('BEARER_TOKEN', $response->response->original['token']);
    }

    // Verifica se o Endpoint vai responder corretamente.
    public function test_list_brands()
    {
        $response = $this->get('/v1/brands', ['Authorization' => 'Bearer '.BEARER_TOKEN]);
        $response->assertResponseStatus(200);
    }

    // Verifica se o Endpoint de criação funcionou.
    public function test_create_brand()
    {
        $response = $this->post('/v1/brands',
            ['name' => 'Barla'],
            ['Authorization' => 'Bearer '.BEARER_TOKEN] // <-- Header com o Bearer Token
        );

        // Verifica se funcionou ['status' => 'success']
        $response->seeJson(['status' => 'success']);
        $response->seeJsonStructure(['data']);

        // Verifica se incluiu no banco.
        $response->seeInDatabase('brands', ['name' => 'Barla']);
        $response->assertResponseStatus(200);
    }

    // Teste de update marca.
    public function test_update_brand()
    {
        $old = \App\Models\Brand::find(1);
        $response = $this->put('/v1/brands/'. $old->id,
            ['name' => 'Outro nome'],
            ['Authorization' => 'Bearer '.BEARER_TOKEN] // <-- Header com o Bearer Token
        );

        // Verifica se funcionou ['status' => 'success']
        $response->seeJson(['status' => 'success']);
        $response->seeJsonStructure(['data']);

        $new = \App\Models\Brand::find(1);

        // Verifica se alterou no banco.
        $this->assertNotEquals($new, $old);
    }

    // Testa de delete marca
    public function test_delete_brand()
    {
        $target = \App\Models\Brand::find(1);
        $response = $this->delete('/v1/brands/'. $target->id,
            [], // No delete não precisa mandar parametro nenhum (apenas o ID no final da URL)
            ['Authorization' => 'Bearer '.BEARER_TOKEN] // <-- Header com o Bearer Token
        );

        // Verifica se funcionou ['status' => 'success']
        $response->seeJson(['status' => 'success']);
        $response->missingFromDatabase('brands', ['id' => 1]); // Verificar se realmente removeu do banco.
        $response->assertResponseStatus(200);
    }
}

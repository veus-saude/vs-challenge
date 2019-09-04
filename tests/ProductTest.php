<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class ProductTest extends TestCase
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
    public function test_list_products()
    {
        $response = $this->get('/v1/products', ['Authorization' => 'Bearer '.BEARER_TOKEN]);
        $response->assertResponseStatus(200);

        $response->seeJsonStructure(['current_page', 'data']); // Retorna o JSON de Paginação
    }

    // Testa a GET QueryString (filtros de busca)
    public function test_get_query_filters()
    {
        /**
         * No banco (no seeder inicial), existem 3 produtos:
         *
         * -- Nome [Marca]
         * -- Aciclovir Pomada [Natulab]
         * -- Aciclovir - Comprimidos [Cifarma]
         * -- Protetor Solar - Sun 30 FPS [Avon]
         */

        // Nessa busca, eu quero apenas o Aciclovir Pomada [Natulab]
        $response = $this->get('/v1/products?q=aciclovir&filter=brand:natu', // para mudar a ordenação "sort" é só acrescentar '&sort=id // &sort=name:asc
            ['Authorization' => 'Bearer '.BEARER_TOKEN]
        );
        $response->assertResponseStatus(200);

        $response->seeJsonStructure(['current_page', 'data']); // Retorna o JSON de Paginação
        $response->seeJson(['total' => 1]);
    }

    // Verifica se o Endpoint de criação funcionou.
    public function test_create_product()
    {
        $response = $this->post('/v1/products',
            [
                'name' => 'Pó Anticeptico',
                'brand_id' => 3,
                'price' => 10,
                'qty' => 0
            ],
            ['Authorization' => 'Bearer '.BEARER_TOKEN] // <-- Header com o Bearer Token
        );

        // Verifica se funcionou ['status' => 'success']
        $response->seeJson(['status' => 'success']);
        $response->seeJsonStructure(['data']);

        // Verifica se incluiu no banco.
        $response->seeInDatabase('products', ['name' => 'Pó Anticeptico']);
        $response->assertResponseStatus(200);
    }

    // Testa o update product
    public function test_update_product()
    {
        $old = \App\Models\Product::find(1);
        $response = $this->put('/v1/products/'.$old->id,
            [
                'name' => 'Pó Anticeptico',
                'brand_id' => 3,
                'price' => 10,
                'qty' => 0
            ],
            ['Authorization' => 'Bearer '.BEARER_TOKEN]
        );

        // Verifica se funcionou ['status' => 'success']
        $response->seeJson(['status' => 'success']);
        $response->seeJsonStructure(['data']);

        $new = \App\Models\Product::find(1);

        // Verifica se alterou no banco.
        $this->assertNotEquals($new, $old);
    }

    // Testa o delete product
    public function test_delete_product()
    {
        $target = \App\Models\Product::find(1);
        $response = $this->delete('/v1/products/'. $target->id,
            [], // No delete não precisa mandar parametro nenhum (apenas o ID no final da URL)
            ['Authorization' => 'Bearer '.BEARER_TOKEN] // <-- Header com o Bearer Token
        );

        // Verifica se funcionou ['status' => 'success']
        $response->seeJson(['status' => 'success']);
        $response->missingFromDatabase('products', ['id' => 1]); // Verificar se realmente removeu do banco.
        $response->assertResponseStatus(200);
    }
}

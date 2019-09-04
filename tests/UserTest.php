<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_register_user_api()
    {
        // Testa o endpoint de cadastro de usuário na API
        $response = $this->post('/v1/auth/register', [
            'name'      => 'Lucas Maia',
            'email'     => 'lucas.codemax@yahoo.com.br',
            'password'  => '123456'
        ]);

        // Verifica se funcionou ['status' => 'success']
        $response->seeJson(['status' => 'success']);

        // Verifica se incluiu no banco.
        $response->seeInDatabase('users', ['email' => 'lucas.codemax@yahoo.com.br']);
    }

    public function test_auth_generate_token()
    {
        // Tenta fazer login com o usuário criado no Seeder
        $response = $this->post('/v1/auth/user', [
            'email'     => 'lucas.codemax@gmail.com',
            'password'  => 'himura08'
        ]);

        // Verifica se retornou o Token que será usado em outros endpoints que requerer autenticação
        $response->seeJsonStructure(['token', 'user']);

        /**
         * Seguindo uma lógica que estaríamos desenvolvendo um Software SPA (Single Page Application)
         * com algum framework Javascript (VueJS, Angular, ReactJS, etc..).
         *
         * A API e a interface frontend devem funcionar de forma isolada, onde:
         *  -- A API responde através da Porta: 81 (ou qualquer porta, exceto 80)
         *  -- A interface deve rodar na Porta: 80 (ou atráves de um serviço CDN externo, exemplo: Amazon S3, Google Cloud CDN)
         *
         * As chamadas que requerem autenticação (Bearer Token) seriam armazenadas no Storage do Browser (após o login)
         * e serão especificados no Header das chamadas à API futuramente.
         */

        if(!defined('BEARER_TOKEN')) define('BEARER_TOKEN', $response->response->original['token']);
        // Como não estamos testando em uma interface, vamos fazer assim pra continuar os testes. Beleza? =)
    }

    public function test_endpoint_with_auth_token()
    {
        // O Header das chamadas (exemplo):
        // $header['Authorization'] = "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJsdW1lbi1qd3QiLCJzdWIiOjEsImlhdCI6MTU2NzA0OTU4NSwiZXhwIjoxNTY3MDU2Nzg1fQ.AMZOeWyYhB2fOKer7jf4lSdI-NZRJT7XOC4gUL_GQwE"
        $response = $this->get('/v1/products', ['Authorization' => 'Bearer '.BEARER_TOKEN]);
        $response->assertResponseStatus(200);
    }

    // Testa a tentativa de acesso à uma rota protegida, sem informar o token (ou se o token estiver expirado)
    public function test_endpoint_without_auth_token()
    {
        $response = $this->get('/v1/products');
        $response->assertResponseStatus(401); // Deve retornar UNAUTHORIZED 401
        $response->seeJsonStructure(['error']); // Deve retornar uma mensagem de erro.
    }
}

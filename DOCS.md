## Documentação de instalação da API

Você pode esta API em funcionamento no painel que desenvolvi em VueJS no link [https://veus.neimeg.com](https://veus.neimeg.com), este painel consome a API que está no endereço [https://veus-api.neimeg.com](https://veus-api.neimeg.com) 

### Pré requisitos
- PHP >=7.2
- mySQL server

### Instalação

Para o desenvolvimento da API foi utilizado o framework Laravel, portanto, a instalação deve ser feita como qualquer instalação do mesmo:

    composer install

Concluída a instalação, você deve copiar o arquivo `.env.example` para `.env` e editar as configurações de conexão com o banco de dados, caso você esteja usando o ambiente de desenvolvimento padrão do Laravel (Homestead), você só precisará alterar o nome do banco de dados:

    DB_DATABASE=nome-do-banco
    DB_USERNAME=usuario
    DB_PASSWORD=senha

Crie o banco de dados com o mesmo nome inserido na variável `DB_DATABASE` no servidor indicado na variável `DB_HOST`.

Com o banco de dados criado e a conexão configurada é hora de criar as tabelas:

`php artisan migrate`

Agora você pode popular as tabelas com dados de exemplo:

`php artisan db:seed`

O comando acima cadastrará no banco de dados algumas marcas, produtos e um usuário para testes.
Finalmente, execute o comando

`php artisan passport:install`

Este comando cadastrará 2 clientes para a API

---

A instalação da API está finalizada e ela está pronta para receber conexões.

A autenticação deve ser feita passando as credenciais de usuário (email e senha) junto com um código de cliente da API e id de cliente (client_secret, e client_id), que se encontram na tabela oauth_clients.

Ex:

    axios.post('https://sua-api.com/oauth/token', {
    	grant_type: 'password',
    	client_secret: '8YIAYxMzMBMJ7fOVDgc7iMVV6Qn1g7lnjNYIfiNO',
    	client_id: 2,
    	username:'teste@veus.com.br',
    	password: 'teste-veus',
    }).then( r => {
    	r.data.access_token
    })

O `access_token` contido na resposta é o token que deve ser armazenado localmente para fazer novas chamadas na API:

    axios.defaults.headers.common = {
      ...axios.defaults.headers.common,
      "Content-Type": 'application/json',
      "Authorization": `Bearer ${ACCESS_TOKEN}` : undefined,
    };
    
    axios.get('https://sua-api.com/api/v1/products').then( r => {
      this.products = r.data
    })

Em caso de dúvidas estou à disposição no telefone (21) 97223 0837 ou email neimeg@gmail.com.

Obrigado.

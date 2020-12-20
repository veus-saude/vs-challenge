<p align="center">
    <img src="https://i.imgur.com/2LUR2yy.png">
</p>

## Sobre a VEUS

Há 25 anos no mercado, a **Veus Technology** é uma empresa brasileira ligada ao segmento de saúde com foco na inovação tecnológica. É responsável por vários projetos pioneiros e estratégicos na área laboratorial, médica e recentemente hospitalar.

## Desafio VS

Você deve implementar uma API utilizando *PHP* > 7.0. Nós recomendamos que você tente manter o seu códgo o mais simples possível utilizando os frameworks *Laravel, Lumen ou Synfony*. Se você precisar de qualquer informação adicional ou esclarecimento, você pode nos contatar pelo e-mail: **sistemas@veus.com.br**.

Vamos imaginar que a sua empresa possua um e-commerce e venda alguns produtos para laboratórios e hospitais...

Sua tarefa é desenvolver um **CRUD** de Produtos e implementar um serviço de buscas desses produtos. Um produto possui nome, marca, preço e quantidade em estoque.
A API deve requerer **autenticação** e permitir __search query__ através do método **GET** e suportar filtros opcionais nos campos do produto.

Por exemplo: Um cliente deve conseguir buscar todas as seringas da marca BUNZL fazendo a seguinte requisição:

`https://example.com/api/v1/products?q=seringa&filter=brand:BUNZL`

A API também deve suportar __pagination__, __versioning__ e __sorting__.

Sinta-se livre para usar qualquer library ou framework da sua preferência mas a regra de negócio deve estar o mais desaclopada possível deles.

Por favor, **não se esqueça** de providenciar uma pequena documentação de como levantar e testar o seu projeto.

Bônus:
* Docker
* Unit Test
* User Interface

---
Você será avaliado de acordo com a senioridade da posição a qual está aplicando. Ao finalizar o desafio você deve submeter o **Pull Request** com o seu código para a avaliação, após isso nos entrarem em contato com você através do e-mail passando um feedback do seu projeto.

Instruções para build (Miguel W D Machado):

configuração do apache:

copiar os arquivos em anexo para a pasta /etc/apache2/sites-available
a2ensite apibatalha.conf
a2ensite clientbatalha.conf
service apache2 force-reload

incluir no arquivo /etc/hosts as seguintes linhas:

127.0.1.2 api_veus api_veus.com.br

comandos para preparação dos sistemas:

banco de dados:

mysql:

acessar o mysql;
use mysql;
CREATE DATABASE desafio_veus CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
CREATE USER 'veus'@'localhost' identified with mysql_native_password by 'bdadm@123';
GRANT ALL PRIVILEGES ON desafio_veus.* TO 'veus'@'localhost';
FLUSH PRIVILEGES;

ou

mariadb:

acessar o mysql;
use mysql;
CREATE DATABASE desafio_veus CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
CREATE USER 'veus'@'localhost' identified by 'bdadm@123';
GRANT ALL PRIVILEGES ON desafio_veus.* TO 'veus'@'localhost';
FLUSH PRIVILEGES;

aplicação:

- abrir uma sessão de terminal;
- cd /var/www/
-
- após a clonagem do repositório, entrar na respectiva pasta e executar os seguintes comandos:

sudo chmod 777 storage/framework/sessions/ -fR
sudo chmod 777 storage/logs/ -fR
composer install
php artisan migrate
php artisan db:seed
php artisan cache:clear && php artisan route:clear && php artisan config:clear && php artisan view:clear

Observações:

- Existe um usuário administrador criado com os seguintes dados de acesso: usuário: administrador@administrador.com.br - senha: admin123;
- Também foram incluídos alguns dados de exemplo para teste;
- Todos os cadastros realizados a partir do site, cadastrará apenas usuários comuns (não administradores). Estes usuários (comuns) não poderão cadastrar nenhum
produto novo, não poderá alterá-lo, nem fazer lançamento no estoque. Somente o usuário administrador@administrador.com.br, já cadastrado poderá realizar tais
operações.

Estas instruções foram enviadas para o email sistemas@veus.com.br com o arquivo de configuração do servidor apache.


Atenciosamente,

Miguel W D Machado

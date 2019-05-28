<p align="center">
    <img src="https://i.imgur.com/2LUR2yy.png">
</p>

## VS Challenge  

### Installation

- Copy
    ````
    cp -v .env.example .env
    ````
    ````
    cp -v docker-compose.yml.example docker-compose.yml
    ````

- Then run
    ````
    docker-compose up -d
    ````

- In mysql container create databases veus and veus_test

- Access the apache container
    ````
    docker exec -it apache-veus bash
    ````

- Install the dependencies:
    ````
    composer install --ignore-platform-reqs
    ````

- Run migrates:
    ````
    php artisan migrate --database=testing
    php artisan migrate
    php artisan db:seed
    ````

### Testing

After installing, run `./vendor/phpunit/phpunit//phpunit tests/`.

### Using

To generate token you need send post localhost/auth/login:
````
{
	"email": "master@veus.com.br",
	"password" : "12345"
}
 ````

 After that its possible to use the api with token in Authorization header:
 ````
 localhost/api/v1/products
  ````
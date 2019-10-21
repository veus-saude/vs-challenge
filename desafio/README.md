# Iniciando
Basta executar o comando abaixo:
```
sh init.sh
```

Para explicação do funcionamento do SH segue abaixo detalhamento

## Iniciar o Projeto

Inicio o projeto utilizando o comando abaixo

```
docker-compose build && docker-compose up -d
```


## Executando Migrações
Para executar as migrações utilize o comando abaixo

```
docker-compose up -d migrate
```

## Populando o banco
Popule o banco utilizando o comando

```
docker-compose run --rm app php artisan db:seed
```


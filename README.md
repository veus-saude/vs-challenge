<p align="center">
    <img src="https://i.imgur.com/2LUR2yy.png">
</p>

---

[![Build Status](https://travis-ci.org/pplanel/vs-challenge.svg)](https://travis-ci.org/pplanel/vs-challenge)

## Requisitos

* Composer
* Docker
* Git

## Como iniciar o projeto
Apos clonar o projeto instale as dependencias
```
composer install
```
Agora voce deve buildar as imagens do docker
```
docker-compose build
```
Pronto, agora voce pode subir as imagens
```
docker-compose up -d
```

## Como testar os endpoints
Existem duas formas de testar os endpoints

### Postman
O arquivo veus-api.postman-collection.json esta na raiz do projeto e nele esta contido todas os testes de endpoint

### PHPUnit
Para executar os testes voce deve digitar
```
docker-compose exec api ../vendor/bin/phpunit ../tests
```
O projeto esta setado no __TravisCI__ no seguinte endereco: https://travis-ci.org/pplanel/vs-challenge
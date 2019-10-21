#!/bin/sh
docker-compose build
docker-compose up -d
docker-compose up -d migrate
docker-compose run --rm app php artisan db:seed



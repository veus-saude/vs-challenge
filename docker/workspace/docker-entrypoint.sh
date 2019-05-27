#!/bin/bash

CONTAINER_ALREADY_STARTED="CONTAINER_ALREADY_STARTED_PLACEHOLDER"
if [ ! -e $CONTAINER_ALREADY_STARTED ]; then
    touch $CONTAINER_ALREADY_STARTED
    cd /var/www

    echo "Installing project dependencies..."
    composer install -o

    echo "Configuring project..."
    cp /var/www/.env.example /var/www/.env
    
    php artisan key:generate
    php artisan migrate
    php artisan passport:install
    php artisan db:seed
    
else
    echo "-- Not first container startup --"
fi

tail -f /dev/null
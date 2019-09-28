#!/bin/sh
cd /var/www/html
cp .env.example .env
composer install
php artisan migrate
php artisan db:seed
curl -sL https://deb.nodesource.com/setup_12.x | bash -
apt-get install nodejs
cd /var/www/html/resources/web
npm install
npm run build

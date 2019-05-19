#!/bin/bash

sed -i '54cServerName localhost' /etc/apache2/apache2.conf

sed -i -e "s!/var/www/html!/var/www/html/public!g" /etc/apache2/sites-available/*.conf
sed -i -e "s!/var/www/!/var/www/public!g" /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

sed -i "13c<Directory /var/www/html/public/>" /etc/apache2/sites-available/000-default.conf
sed -i "14c Options Indexes FollowSymLinks MultiViews" /etc/apache2/sites-available/000-default.conf
sed -i "15c AllowOverride all" /etc/apache2/sites-available/000-default.conf
sed -i "16c Order allow,deny" /etc/apache2/sites-available/000-default.conf
sed -i "17c allow from all" /etc/apache2/sites-available/000-default.conf
sed -i "18c Require all granted" /etc/apache2/sites-available/000-default.conf
sed -i "19c </Directory>" /etc/apache2/sites-available/000-default.conf

composer install -d /var/www/html --no-dev --no-interaction -o
cd /var/www/html
chmod -R 775 storage
cp .env.example .env

php artisan migrate
php artisan passport:install
php artisan db:seed

#bash
exec /usr/sbin/apachectl -D FOREGROUND
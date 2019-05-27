#!/usr/bin/env sh

_="$(dirname "$0")"

$_/user_setup www-data
$_/composer

# Create .env
cp .env.example .env

echo "==> Running migration"
php artisan migrate

echo "==> Installing passport"
php artisan passport:install

# Start php-fpm
echo "===> Initializing php-fpm"
php-fpm
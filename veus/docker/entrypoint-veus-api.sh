#!/bin/sh

cd /var/www/html
composer clear-cache
composer install

# Cria as tabelas e roda o comando seed
php artisan migrate:fresh --seed


#
# original entrypoint script
#

# first arg is `-f` or `--some-option`
if [ "${1#-}" != "$1" ]; then
	set -- apache2-foreground "$@"
fi

exec "$@"

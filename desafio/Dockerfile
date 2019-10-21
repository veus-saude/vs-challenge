FROM nasajon/php:7.1-fpm-dev

USER nginx

COPY . /var/www/html

USER root

RUN sed -i "s#root /var/www/html;#root /var/www/html/public;#" /etc/nginx/conf.d/default.conf && \
    echo 'security.limit_extensions = ' >> /etc/php7/php-fpm.conf && \
    sed -i 's/cgi.fix_pathinfo=0/cgi.fix_pathinfo=1/g' /etc/php7/php.ini

RUN chmod -fR 777 storage && \
    chmod -fR 777 bootstrap/cache
    
CMD php artisan serve --host=0.0.0.0 --port=80
EXPOSE 80
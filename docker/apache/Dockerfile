FROM php:7.2-apache


#------------------------
# Environment variables
#------------------------
ENV TIMEZONE=America/Sao_Paulo
ENV APACHE_DOCUMENT_ROOT /var/www/public


#------------------------
# Enable Apache modules
#------------------------
RUN a2enmod rewrite


#------------------------
# Install and configure
# PHP dependencies
#------------------------
RUN set -ex \
 && buildDeps='libjpeg62-turbo-dev libpng-dev' \
 && apt update \
 && apt install -y --no-install-recommends $buildDeps \
 && rm -fr /var/lib/apt/lists/* \
 && docker-php-ext-configure gd \
    --with-jpeg-dir=/usr/include/ \
    --with-png-dir=/usr/include/ \
 && docker-php-ext-install -j"$(nproc)" \
    gd \
    mbstring \
    opcache \
    pdo \
    pdo_mysql \
    zip


#------------------------
# Set document root
#------------------------
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf


#------------------------
# Set PHP timezone
#------------------------
RUN echo "date.timezone=${TIMEZONE}" >> /usr/local/etc/php/php.ini


WORKDIR /var/www
RUN chown -R www-data:www-data /var/www

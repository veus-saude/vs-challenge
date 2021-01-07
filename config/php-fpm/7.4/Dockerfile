FROM php:7.4-fpm

RUN apt-get update \
 && apt-get install -y apt-utils libicu-dev libpq-dev libxslt-dev libmagickwand-dev libzip-dev \
 && docker-php-ext-configure gd  \
 && docker-php-ext-install -j$(nproc) gd \
 && docker-php-ext-install intl pdo pdo_pgsql bcmath xsl soap pdo_mysql gd zip \
 && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
 && docker-php-ext-install pdo pdo_pgsql pgsql \
 && docker-php-ext-configure opcache --enable-opcache \
 && docker-php-ext-install opcache

RUN pecl install imagick \
 && docker-php-ext-enable imagick

RUN pecl install xdebug \
 && docker-php-ext-enable xdebug

RUN docker-php-ext-install mysqli pdo pdo_mysql
RUN apt-get update -y && apt-get install -y libwebp-dev libjpeg62-turbo-dev libpng-dev libxpm-dev \
    libfreetype6-dev
RUN apt-get update && \
    apt-get install -y \
        zlib1g-dev 


RUN apt-get install -y libzip-dev
RUN docker-php-ext-install zip

# RUN docker-php-ext-configure gd --with-gd --with-webp-dir --with-jpeg-dir \
#     --with-png-dir --with-zlib-dir --with-xpm-dir --with-freetype-dir


RUN docker-php-ext-configure gd 


RUN sed -ie 's/pm.max_children = 5/pm.max_children = 15/' /usr/local/etc/php-fpm.d/www.conf \
 && sed -ie 's/pm.max_spare_servers = 3/pm.max_spare_servers = 15/' /usr/local/etc/php-fpm.d/www.conf \
 && sed -ie 's/pm.start_servers = 2/pm.start_servers = 10/' /usr/local/etc/php-fpm.d/www.conf

COPY php.ini /usr/local/etc/php/php.ini

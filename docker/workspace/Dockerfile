FROM php:7.2-cli


#------------------------
# Environment variables
#------------------------
ARG TIMEZONE=America/Sao_Paulo
ARG PHP_MEMORY_LIMIT=512M
ARG PHP_MAX_EXECUTION_TIME=360
ARG PUID=1000
ARG PGID=1000


#------------------------
# System Update
#------------------------
RUN apt-get update \
 && apt-get upgrade -y \
 && apt-get install -y \
    build-essential \
    git \
    gnupg \
    libxml2-dev \
    libbz2-dev \
    mysql-client \
    ssh \
    wget \
    curl


#------------------------
# Set System TimeZone
#------------------------
RUN cp /usr/share/zoneinfo/${TIMEZONE} /etc/localtime \
 && echo "${TIMEZONE}" >> /etc/timezone


#------------------------
# Add User\Group
#------------------------
RUN groupadd -g ${PGID} developers \
 && useradd -d /home/developer -G developers -u ${PUID} developer \
 && mkdir /home/developer \
 && chown developer:developer /home/developer


#------------------------
# Composer
#------------------------
RUN curl -s http://getcomposer.org/installer | php \
 && echo "export PATH=${PATH}:/var/www/vendor/bin" >> ~/.bashrc \
 && mv composer.phar /usr/local/bin/composer


#------------------------
# PHP Extensions
#------------------------
RUN docker-php-ext-install \
    pdo \
    pdo_mysql \
    ctype \
    dom \
    bz2

#------------------------
# Install and configure
# PHP dependencies
#------------------------
RUN set -ex \
 && buildDeps='libjpeg62-turbo-dev libpng-dev' \
 && apt-get update \
 && apt-get install -y --no-install-recommends $buildDeps \
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
    sockets \
    zip

#------------------------
# Install and configure
# PHP Memcached
#------------------------
RUN set -ex \
 && buildDeps='libmemcached-dev zlib1g-dev' \
 && apt-get update \
 && apt-get install -y --no-install-recommends $buildDeps \
 && curl -L -o /tmp/memcached.tar.gz "https://github.com/php-memcached-dev/php-memcached/archive/php7.tar.gz" \
 && mkdir -p /usr/src/php/ext/memcached \
 && tar -C /usr/src/php/ext/memcached -zxvf /tmp/memcached.tar.gz --strip 1 \
 && docker-php-ext-configure memcached \
 && docker-php-ext-install memcached \
 && rm /tmp/memcached.tar.gz


#------------------------
# PHP ini
#------------------------
RUN echo "date.timezone=${TIMEZONE}" >> /usr/local/etc/php/php.ini \
 && echo "memory_limit=${PHP_MEMORY_LIMIT}" >> /usr/local/etc/php/php.ini \
 && echo "max_execution_time=${PHP_MAX_EXECUTION_TIME}" >> /usr/local/etc/php/php.ini


#------------------------
# Composer configuration
#------------------------
RUN mkdir /home/developer/.composer \
 && chown developer:developers -R /home/developer


COPY docker-entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-entrypoint.sh \
 && ln -s /usr/local/bin/docker-entrypoint.sh /

USER developer

ADD ./composer.json /home/developer/.composer/composer.json

RUN composer global install \
 && echo 'export PATH="$PATH:/var/www/vendor/bin:$HOME/.composer/vendor/bin"' >> ~/.bashrc \
 && composer config --global --auth github-oauth.github.com 55cdb92a6b0acc7b254a7a5b00ef91db91f81115

USER root

#------------------------
# Cleanup
#------------------------
RUN rm -rf /tmp/*

USER developer

WORKDIR /var/www

ENTRYPOINT ["docker-entrypoint.sh"]

CMD ["/bin/bash"]
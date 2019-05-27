FROM php:7.3-fpm-alpine

LABEL maintainer "Davi Freire"

RUN echo "http://dl-cdn.alpinelinux.org/alpine/edge/community" >> /etc/apk/repositories

RUN apk update && apk --no-cache add \
    build-base \
    git \
    shadow

RUN docker-php-ext-install \
    pdo_mysql \
    mysqli

# Copy composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy application files (Files are changed between builds so docker cache won't be used for subsequent layers)
COPY . /opt/veus
WORKDIR /opt/veus

EXPOSE 80

CMD /opt/veus/docker/app/start.sh
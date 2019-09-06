FROM php:7.3.6-fpm-alpine3.9

# Algumas extencoes
RUN apk add --no-cache openssl bash mysql-client
RUN docker-php-ext-install pdo pdo_mysql

# Dockerize
ENV DOCKERIZE_VERSION v0.6.1
RUN wget https://github.com/jwilder/dockerize/releases/download/$DOCKERIZE_VERSION/dockerize-alpine-linux-amd64-$DOCKERIZE_VERSION.tar.gz \
    && tar -C /usr/local/bin -xzvf dockerize-alpine-linux-amd64-$DOCKERIZE_VERSION.tar.gz \
    && rm dockerize-alpine-linux-amd64-$DOCKERIZE_VERSION.tar.gz

# Diretorio de trabalho
WORKDIR /var/www

# Apaga o conteudo
RUN rm -rf /var/www/html

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# 
# RUN composer install && \
#     cp .env.example .env && \
#     php artisan key:generate && \
#     php artisan config:cache

# Copia o conteudo para dentro da imagem
# COPY . /var/www

# Cria um link simbolico da pasta public
RUN ln -s public html

EXPOSE 9000

ENTRYPOINT ["php-fpm"]

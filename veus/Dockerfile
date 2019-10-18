FROM heliortf/php-7.2:latest

# Adiciona o unzip
RUN apt-get -y install unzip

WORKDIR /var/www/html

# Copia o entrypoint pra configurar o projeto
COPY ./docker/entrypoint-veus-api.sh /usr/local/bin
RUN chmod 0755 /usr/local/bin/entrypoint-veus-api.sh

ENTRYPOINT ["/usr/local/bin/entrypoint-veus-api.sh"]
CMD ["apache2-foreground"]

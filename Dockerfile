FROM ubuntu:18.04

ENV DEBIAN_FRONTEND noninteractive

RUN apt-get update && apt-get install -yq \
    apt-utils \
    curl \
    # Install git
    git \
    # Install apache
    apache2 \
    # Install php 7.2
    libapache2-mod-php7.2 \
    php7.2-cli \
    php7.2-json \
    php7.2-curl \
    php7.2-fpm \
    php7.2-gd \
    php7.2-ldap \
    php7.2-mbstring \
    php7.2-mysql \
    php7.2-soap \
    php7.2-sqlite3 \
    php7.2-xml \
    php7.2-zip \
    php7.2-intl \
   # php-imagick \
    # Install tools
    nano \
	less \
	wget \
	gnupg 
	# syslog-ng-core \
	# syslog-ng

RUN curl -o /tmp/composer-setup.php https://getcomposer.org/installer \
	&& curl -o /tmp/composer-setup.sig https://composer.github.io/installer.sig \
	# Make sure we're installing what we think we're installing!
	&& php -r "if (hash('SHA384', file_get_contents('/tmp/composer-setup.php')) !== trim(file_get_contents('/tmp/composer-setup.sig'))) { unlink('/tmp/composer-setup.php'); echo 'Invalid installer' . PHP_EOL; exit(1); }" \
	&& php /tmp/composer-setup.php --no-ansi --install-dir=/usr/local/bin --filename=composer --snapshot \
	&& rm -f /tmp/composer-setup.*


RUN wget https://phar.phpunit.de/phpunit.phar

RUN chmod +x phpunit.phar

RUN mv phpunit.phar /usr/local/bin/phpunit


# COPY app /var/www/html/

RUN mv /var/www/html/index.html /var/www/html/index-old.html

# RUN composer install -d /var/www/html --no-dev --no-interaction -o

# RUN cp /var/www/html/.env_prod /var/www/html/.env

WORKDIR /

# COPY config.conf /etc/syslog-ng/syslog-ng.conf

# RUN ldconfig

# RUN sed -i '12cSYSLOGNG_OPTS="--no-caps"' /etc/default/syslog-ng

RUN a2enmod rewrite

# RUN wget -O - https://download.newrelic.com/548C16BF.gpg | apt-key add -
# RUN echo "deb http://apt.newrelic.com/debian/ newrelic non-free" \
# > /etc/apt/sources.list.d/newrelic.list
# RUN apt-get update
# RUN DEBIAN_FRONTEND=noninteractive apt-get -y install newrelic-php5

WORKDIR /

EXPOSE 80

COPY start.sh start.sh
CMD ["./start.sh"]
ENTRYPOINT ["sh"]
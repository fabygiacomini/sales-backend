FROM php:7.3.0-fpm

COPY composer.lock composer.json /var/www/

RUN apt-get update && apt-get install -y mysql-client \
    bash

RUN docker-php-ext-install mysqli \
    pdo_mysql

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

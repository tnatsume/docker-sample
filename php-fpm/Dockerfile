FROM php:7.2-fpm

# pdo install
RUN docker-php-ext-install pdo_mysql pdo

# composer install
RUN curl -sS https://getcomposer.org/installer | php
RUN mv composer.phar /usr/local/bin/composer

# git install
RUN apt-get update
RUN apt-get install -y git
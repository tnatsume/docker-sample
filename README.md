# Version
PHP : 7.4.13<br>
MYSQL : 8.0.22(latest)

# access
## web
http://localhost/

## phpMyAdmin
http://localhost:8080

# HOW to use

## git clone
$ git clone -b main https://github.com/tnatsume/docker-sample.git docker-sample

## How to sand container
$ docker-compose up -d 

## To go into docker
$ docker exec -it {folda name}_php-fpm_1 bash

# into container
## At first, install composer
'# composer install
'# composer require predis/predis

## how to migrate
'# php artisan migrate

## How to Authentication
'# composer require laravel/ui
'# php artisan ui vue --auth

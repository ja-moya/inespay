FROM php:8.2-cli

RUN apt-get update && apt-get install -y \
    zip unzip git curl procps \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug

COPY ./docker/xdebug.ini /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY . .

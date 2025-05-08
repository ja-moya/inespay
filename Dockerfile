FROM php:8.2-cli

RUN apt-get update && apt-get install -y \
    zip unzip git

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY . .

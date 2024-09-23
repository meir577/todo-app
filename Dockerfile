FROM php:8.1-fpm

RUN apt-get update && apt-get install -y \
    && docker-php-ext-install pdo pdo_mysql

WORKDIR /var/www

COPY . .

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN composer install

EXPOSE 9000

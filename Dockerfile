FROM php:8.1-fpm

WORKDIR /var/www/html

RUN apt-get update && docker-php-ext-install pdo pdo_mysql

COPY --from=composer:2.5 /usr/bin/composer /usr/bin/composer

COPY . .

RUN composer install --no-interaction --prefer-dist

RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

RUN php artisan optimize:clear

RUN apt-get update && apt-get install -y nginx

COPY default.conf /etc/nginx/conf.d/default.conf

EXPOSE 80

CMD service nginx start && php-fpm

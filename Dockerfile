FROM php:8.1-apache

WORKDIR /var/www/html

RUN a2enmod rewrite

RUN apt-get update && docker-php-ext-install pdo pdo_mysql

COPY --from=composer:2.5 /usr/bin/composer /usr/bin/composer

COPY . /var/www/html

RUN composer install --no-interaction --prefer-dist

RUN chown -R www-data:www-data /var/www/html/storage
RUN chmod -R 775 /var/www/html/storage

RUN php artisan optimize:clear
RUN php artisan migrate
RUN php artisan db:seed

EXPOSE 80

CMD ["apache2-foreground"]

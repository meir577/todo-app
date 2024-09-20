FROM php:8.1-apache

# Set working directory
WORKDIR /var/www/html

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Install dependencies
RUN apt-get update && \
    apt-get install -y git unzip && \
    docker-php-ext-install pdo pdo_mysql && \
    rm -rf /var/lib/apt/lists/*

# Copy Composer from the official image
COPY --from=composer:2.5 /usr/bin/composer /usr/bin/composer

# Copy application files
COPY . .

# Install PHP dependencies
RUN composer install --no-interaction --prefer-dist && \
    php artisan optimize:clear && \
    chown -R www-data:www-data /var/www/html

# Expose the Apache port
EXPOSE 80

# Run Apache in the foreground
CMD ["apache2-foreground"]

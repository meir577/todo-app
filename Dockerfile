# Dockerfile
FROM php:8.1-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    && docker-php-ext-install pdo pdo_mysql

# Set the working directory
WORKDIR /var/www

# Copy the existing application directory contents
COPY . .

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install dependencies
RUN composer install

# Expose port 9000
EXPOSE 9000

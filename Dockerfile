FROM php:8.2-apache

# Install PHP extensions for MySQL support
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Enable Apache mod_rewrite (optional, but useful for frameworks)
RUN a2enmod rewrite

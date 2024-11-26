FROM php:8.0-apache

# Set the working directory
WORKDIR /var/www/html

# Update and upgrade the package manager
RUN apt update -y && apt upgrade -y

# Install and enable required PHP extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable mysqli pdo_mysql

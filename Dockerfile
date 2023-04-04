FROM php:8.1-apache

RUN docker-php-ext-install \
    xml \
    zip \
    curl \
    bcmath \
    pdo_mysql \
    mbstring \
    gd

COPY . /var/www/html/
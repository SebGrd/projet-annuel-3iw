FROM php:7.4-apache

RUN apt-get update -y && apt-get install -y libpng-dev libfreetype6-dev libyaml-dev

# Install PDO MySQL driver
# See https://github.com/docker-library/php/issues/62
RUN docker-php-ext-install pdo mysqli pdo_mysql

RUN pecl install yamL

RUN docker-php-ext-configure gd --with-freetype && docker-php-ext-install gd

# Workaround for write permission on write to MacOS X volumes
# See https://github.com/boot2docker/boot2docker/pull/534
RUN usermod -u 1000 www-data

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# RUN a2enmod headers

WORKDIR /var/www

# Enable yaml
#RUN a2enmod yaml
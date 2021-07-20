FROM php:7.4-apache

RUN apt-get update -y \
&& apt-get install -y libpng-dev libfreetype6-dev libyaml-dev \
&& docker-php-ext-install pdo mysqli pdo_mysql \
&& docker-php-ext-configure gd --with-freetype && docker-php-ext-install gd \
&& pecl install yamL \
&& a2enmod rewrite proxy proxy_http

# Workaround for write permission on write to MacOS X volumes
# See https://github.com/boot2docker/boot2docker/pull/534
RUN usermod -u 1000 www-data

WORKDIR /var/www

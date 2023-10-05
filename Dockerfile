FROM php:8.2-apache

# install composer 
RUN apt-get update -y && apt-get install git -y

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && composer --ansi --version --no-interaction

# copy composer related files 
COPY composer.json composer.lock /var/www/html/
RUN composer install --prefer-source

# copy whole project
COPY ./ /var/www/html/


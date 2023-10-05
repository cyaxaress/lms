FROM php:8.2-apache

# install composer 
RUN apt-get update -y && apt-get install git libzip-dev zip -y && \
    docker-php-ext-install zip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && composer --ansi --version --no-interaction

# copy project to docker image
COPY ./ /var/www/html/
RUN composer install


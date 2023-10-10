FROM php:8.2-apache
ENV APACHE_DOCUMENT_ROOT /var/www/html/public/

# install composer 
RUN apt-get update -y && apt-get install git libzip-dev zip -y && \
    docker-php-ext-install zip

# fix apache public dir
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf    

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && composer --ansi --version --no-interaction

# copy project to docker image
COPY ./ /var/www/html/
RUN composer install

# fix storage permissions
RUN chown -R www-data:www-data /var/www/html/storage/


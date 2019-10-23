FROM php:7.3-fpm-alpine

## Install system dependencies
RUN apk update && \
    apk add --no-cache --virtual dev-deps git autoconf gcc g++ make && \
    apk add --no-cache zlib-dev libzip-dev postgresql-dev

## Install php extensions
RUN pecl install xdebug && \
    docker-php-ext-enable xdebug && \
    docker-php-ext-install zip pdo_pgsql

## Install composer
RUN wget https://getcomposer.org/installer && \
    php installer --install-dir=/usr/local/bin/ --filename=composer && \
    rm installer


ENV APP_ENV=prod
WORKDIR /app

## Copy project files to workdir
COPY . .

## Change files owner to php-fpm default user
RUN chown -R www-data:www-data .

## Remove dev dependencies
RUN composer install --no-dev --no-interaction --optimize-autoloader

## Disable xdebug on production
RUN rm /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

## Cleanup
RUN apk del dev-deps && \
    rm /usr/local/bin/composer
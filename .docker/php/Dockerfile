FROM php:7.4-fpm-alpine3.12

RUN apk update \
 && apk add --no-cache \
    bash \
    git \
    zip \
    unzip

# Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

CMD ["php-fpm", "--nodaemonize"]
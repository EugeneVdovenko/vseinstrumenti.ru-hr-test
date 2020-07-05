FROM php:7.4-fpm-alpine3.12

RUN apk update \
 && apk add --no-cache \
    bash \
    git \
    zip \
    unzip

RUN apk --update --no-cache add \
  php-bcmath \
  php-dom \
  php-ctype \
  php-curl \
  php-fileinfo \
  php-fpm \
  php-gd \
  php-iconv \
  php-intl \
  php-json \
  php-mbstring \
  php-opcache \
  php-openssl \
  php-pdo \
  php-pdo_sqlite \
  php-phar \
  php-posix \
  php-simplexml \
  php-session \
  php-soap \
  php-tokenizer \
  php-xml \
  php-xmlreader \
  php-xmlwriter \
  php-zip \
  && rm -rf /var/cache/apk/*

# Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

CMD ["php-fpm", "--nodaemonize"]
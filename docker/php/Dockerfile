FROM composer:1.8.4 AS composer
FROM php:7.3-fpm-alpine

RUN set -xe \
    && docker-php-ext-install  pdo pdo_mysql

COPY --from=composer /usr/bin/composer /usr/bin/composer

WORKDIR /app/public

CMD ["php", "-S", "0.0.0.0:8080", "/app/server.php"]
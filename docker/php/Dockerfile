FROM php:8-fpm-alpine

RUN docker-php-ext-install -j$(nproc) iconv \
pdo \
pdo_mysql \
mysqli
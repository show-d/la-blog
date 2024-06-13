FROM php:8.2.9

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

ENV COMPOSER_ALLOW_SUPERUSER=1

RUN apt-get update && apt-get install -y zlib1g-dev \
    libzip-dev \
    unzip \
    libpng-dev \
    tzdata

ENV TZ=Asia/Shanghai

RUN docker-php-ext-install pdo pdo_mysql sockets zip gd

RUN mkdir /app

ADD . /app

WORKDIR /app

RUN composer install --no-dev --prefer-dist --optimize-autoloader

CMD php artisan serve --host=0.0.0.0 --port=8000

EXPOSE 8000

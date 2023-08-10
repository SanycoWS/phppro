FROM php:8.2.3-fpm-alpine3.17

ARG GROUP_ID
ARG USER_ID
ARG COMPOSER_VERSION=2.4.1

RUN apk update
RUN apk upgrade

# Встановлюємо необхідні пакети
RUN apk add --no-cache linux-headers
RUN apk add \
    libpq-dev \
    libpng-dev \
    postgresql-dev \
    curl \
    bash \
    autoconf \
    g++ \
    make \
    supervisor \
    zip \
    libzip-dev \
    openssl-dev \
    zlib-dev \
    && rm -rf /var/lib/apt/lists/*

# Встановлюємо розширення PHP

RUN docker-php-ext-configure gd \
    --enable-gd \
    && docker-php-ext-install gd

RUN docker-php-ext-install sockets
RUN docker-php-ext-install pdo_pgsql
RUN docker-php-ext-install pcntl
RUN docker-php-ext-install zip
RUN docker-php-ext-install bcmath

# Вказуємо робочу директорію та власника
WORKDIR /var/www/html

# Встановлення Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer --version=${COMPOSER_VERSION}

USER www-data

CMD ["php-fpm"]

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

# Перевіряємо наявність групи www-data перед створенням
RUN if ! getent group www-data >/dev/null; then \
      addgroup -g ${GROUP_ID} www-data; \
    fi

# Створюємо користувача www-data та встановлюємо йому домашню директорію
# Перевіряємо наявність користувача www-data перед створенням
RUN if ! getent passwd www-data >/dev/null; then \
      adduser -D -G www-data -u ${USER_ID} -s /bin/bash -h /home/www-data www-data; \
    fi

# Змінюємо власника директорій на www-data
RUN chown -R www-data:www-data /var/www/html

# Створюємо батьківську групу та додаємо користувача www-data до неї
RUN addgroup -g ${GROUP_ID} parent
RUN echo http://dl-2.alpinelinux.org/alpine/edge/community/ >> /etc/apk/repositories
RUN apk add -U shadow
RUN usermod -u ${USER_ID} -g ${GROUP_ID} www-data

# Вказуємо робочу директорію та власника
WORKDIR /var/www/html

# Копіюємо файл конфігурації Supervisor
COPY ./docker/php-fpm/supervisord/supervisord.conf /etc/supervisord.conf

# Створюємо каталог для сокета
RUN mkdir -p /var/run/supervisor

# Встановлення Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer --version=${COMPOSER_VERSION}

USER www-data

CMD supervisord -c /etc/supervisord.conf -n

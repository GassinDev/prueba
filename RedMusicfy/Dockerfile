FROM php:8.2-fpm

WORKDIR /app

RUN apt-get update \
    && apt-get -y install git zip libpq-dev default-libmysqlclient-dev \
    && docker-php-ext-install pdo_mysql \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

RUN curl -sL https://getcomposer.org/installer | php -- --install-dir /usr/bin --filename composer

RUN pecl install xdebug

CMD ["php-fpm"]
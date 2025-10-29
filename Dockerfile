FROM php:8.3-apache

RUN apt-get update && apt-get install -y \
    git unzip libicu-dev libzip-dev zlib1g-dev libonig-dev \
 && docker-php-ext-install intl pdo pdo_mysql mbstring zip \
 && a2enmod rewrite \
 && rm -rf /var/lib/apt/lists/*

ENV APACHE_DOCUMENT_ROOT=/var/www/html/webroot
RUN sed -ri "s!DocumentRoot /var/www/html!DocumentRoot ${APACHE_DOCUMENT_ROOT}!g" /etc/apache2/sites-available/000-default.conf \
 && sed -ri "s!<Directory /var/www/>!<Directory /var/www/html/>!g" /etc/apache2/apache2.conf \
 && sed -ri "s!AllowOverride None!AllowOverride All!g" /etc/apache2/apache2.conf

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY app/ ./
RUN composer install --prefer-dist --no-interaction --optimize-autoloader

RUN mkdir -p tmp logs && chmod -R 0777 tmp logs

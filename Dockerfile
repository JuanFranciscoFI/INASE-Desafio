  FROM php:8.3-apache

  RUN apt-get update && apt-get install -y \
      git unzip libicu-dev libzip-dev zlib1g-dev libonig-dev \
  && docker-php-ext-install intl pdo pdo_mysql mbstring zip \
  && a2enmod rewrite \
  && rm -rf /var/lib/apt/lists/*

  RUN mkdir -p /var/www/html/tmp /var/www/html/logs \
  && chmod -R 0777 /var/www/html/tmp /var/www/html/logs

  WORKDIR /var/www/html

FROM php:8.3-apache

WORKDIR /var/www/html/shea254

RUN apt-get update && \
    apt-get upgrade -y &&\
    apt-get install -y \
    unzip \
    zip \
    nodejs \
    npm \
    && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo pdo_mysql

COPY --from=composer:2.6.6 /usr/bin/composer /usr/bin/composer

COPY composer.json composer.lock /var/www/html/shea254/

COPY . .

RUN composer install

RUN npm install

ENV APACHE_DOCUMENT_ROOT /var/www/html/shea254/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf

RUN a2enmod rewrite
RUN sed -i 's/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

EXPOSE 8000

CMD ["apache2-foreground"]

FROM --platform=linux/amd64 php:8.2-apache

WORKDIR /var/www

COPY . .
COPY .htaccess ./
COPY ./docker/httpd.conf /etc/apache2/apache2.conf
COPY ./docker/site.conf /etc/apache2/sites-available/000-default.conf

RUN chown -R www-data:www-data /var/www/storage \
    && chmod -R 755 /var/www/storage

RUN a2enmod rewrite \
    && a2enmod proxy

RUN apt update \
    && apt install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        libonig-dev \
        libzip-dev

RUN docker-php-ext-install -j$(nproc) mbstring iconv zip pdo pdo_mysql \
    && docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
ENV COMPOSER_ALLOW_SUPERUSER 1
RUN composer install --no-dev --optimize-autoloader --prefer-dist --no-progress --no-interaction

VOLUME /var/www/storage/app
VOLUME /var/www/storage/logs

EXPOSE 80

ENTRYPOINT [ "/var/www/init.sh" ]
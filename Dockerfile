FROM php:8.1-fpm-alpine

# Install PHP extensions
RUN apk add --update \
    && apk add --no-cache libxml2 supervisor redis linux-headers \
    && docker-php-ext-install \
        bcmath \
        ctype \
        fileinfo \
        pdo_mysql \
        sockets


# Copy php configuration
COPY docker/php/local.ini /usr/local/etc/php/conf.d/local.ini

# Get latest Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy composer.lock and composer.json
COPY composer.lock composer.json /var/www/

# Set working directory
WORKDIR /var/www/html
COPY . .

RUN composer install --no-interaction --optimize-autoloader --no-dev \
    && composer dump-autoload --no-dev --optimize --classmap-authoritative

COPY docker/supervisor /etc/supervisor/
RUN chown -R www-data:www-data .

CMD ["sh", "-c" , "composer install && php artisan optimize && supervisord -c /etc/supervisor/supervisord.conf"]

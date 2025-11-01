FROM php:8.2-fpm

RUN apt-get update && apt-get install -y --no-install-recommends \
    git curl libpng-dev libonig-dev libxml2-dev zip unzip libzip-dev \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY ./skincare-catalog/ /var/www/html/

RUN composer install --no-dev --optimize-autoloader --no-interaction

RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html \
    && mkdir -p storage/logs storage/cache \
    && chown -R www-data:www-data storage \
    && chmod -R 775 storage

EXPOSE 9000

CMD ["php-fpm"]

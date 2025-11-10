FROM node:20 AS node-builder
WORKDIR /app
COPY ./skincare-catalog/package*.json ./
RUN npm install
COPY ./skincare-catalog/ ./
RUN npm run build

FROM php:8.3-fpm

RUN apt-get update && apt-get install -y --no-install-recommends \
    git curl libpng-dev libonig-dev libxml2-dev zip unzip libzip-dev libicu-dev \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-configure intl \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip intl

RUN pecl install redis && docker-php-ext-enable redis

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY ./skincare-catalog/ ./
COPY --from=node-builder /app/public/build public/build

RUN if [ ! -f .env ]; then \
    if [ -f .env.example ]; then \
        cp .env.example .env; \
    else \
        touch .env; \
    fi; \
fi

RUN composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist

RUN mkdir -p public/css/filament public/js/filament public/fonts/filament
RUN php artisan filament:assets || echo "Filament assets command failed, but continuing..."

RUN cp -r public /var/www/html-public-backup

RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html \
    && mkdir -p storage/logs storage/cache \
    && chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

RUN sed -i 's/listen = 127.0.0.1:9000/listen = 0.0.0.0:9000/' /usr/local/etc/php-fpm.d/www.conf

RUN printf '#!/bin/sh\n\
set -e\n\
if [ ! -f /var/www/html/public/index.php ]; then\n\
  echo "Populating public directory from backup..."\n\
  cp -r /var/www/html-public-backup/* /var/www/html/public/\n\
  chown -R www-data:www-data /var/www/html/public\n\
fi\n\
exec php-fpm\n' > /usr/local/bin/start.sh && chmod +x /usr/local/bin/start.sh

EXPOSE 9000
CMD ["/usr/local/bin/start.sh"]

# Gunakan PHP 8.2 FPM
FROM php:8.2-fpm

# Install dependencies sistem
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Install ekstensi PHP yang diperlukan
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Tambahkan Composer dari image resmi
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Tentukan working directory di dalam container
WORKDIR /var/www/html

# 📦 Copy source code aplikasi dari folder skincare-catalog/app ke container
# (karena Dockerfile ada di skincare-catalog, tapi context build ada di root)
COPY ./skincare-catalog/app /var/www/html

# Jalankan composer install jika ada composer.json
RUN if [ -f "composer.json" ]; then \
    composer install --no-dev --optimize-autoloader --no-interaction; \
    fi

# Set permission dan buat folder storage
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html \
    && mkdir -p /var/www/html/storage/logs \
    && mkdir -p /var/www/html/storage/cache \
    && chown -R www-data:www-data /var/www/html/storage \
    && chmod -R 775 /var/www/html/storage

# Buka port 9000 untuk PHP-FPM
EXPOSE 9000

# Jalankan PHP-FPM
CMD ["php-fpm"]

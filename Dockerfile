FROM php:8.2-fpm

# Install ekstensi yang dibutuhkan Laravel
RUN apt-get update && apt-get install -y \
    git unzip curl libpng-dev libonig-dev libxml2-dev zip libzip-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/ulangin

# Copy semua file (biar composer bisa jalan di build)
COPY . .

# Install dependency PHP
RUN composer install --no-dev --optimize-autoloader

CMD ["php-fpm"]

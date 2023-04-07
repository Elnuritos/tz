FROM php:8.0-fpm

# Устанавливаем зависимости
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libwebp-dev \
    libjpeg-dev \
    libzip-dev \
    libonig-dev \
    zip \
    curl \
    unzip

# Очищаем кэш
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Устанавливаем расширения
RUN docker-php-ext-install pdo_mysql mbstring zip exif pcntl
RUN docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp
RUN docker-php-ext-install gd

# Устанавливаем Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Устанавливаем pdo_pgsql
RUN docker-php-ext-install pdo_pgsql

WORKDIR /var/www

# Копируем существующий код приложения
COPY . /var/www

# Устанавливаем права на папку storage
RUN chown -R www-data:www-data /var/www/storage

# Устанавливаем зависимости
RUN composer install

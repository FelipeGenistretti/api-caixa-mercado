FROM php:8.2-fpm

# Dependências do sistema necessárias
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libpq-dev \
    libzip-dev \
    zip \
    libonig-dev \
    libxml2-dev \
    gnupg \
    autoconf \
    gcc \
    make \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libssl-dev \
    pkg-config \
    && rm -rf /var/lib/apt/lists/*

# Extensões PHP comuns
RUN docker-php-ext-install pdo pdo_pgsql mbstring exif pcntl bcmath xml zip

# Extensão GD (com suporte a jpeg, freetype e png)
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd

# Redis (versão estável compatível com PHP 8.2)
RUN pecl install redis-5.3.7 \
    && docker-php-ext-enable redis

# MongoDB (comentado porque não vai usar agora)
# RUN pecl install mongodb-1.16.3 \
#     && docker-php-ext-enable mongodb

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY . .

# Instala dependências do Laravel
RUN composer install --no-dev --optimize-autoloader

# Permissões para o Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 9000
CMD ["php-fpm"]

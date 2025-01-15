FROM --platform=linux/arm64 php:8.2-fpm-alpine

# Install dependencies
RUN apk add --no-cache \
    icu-dev \
    libzip-dev \
    libpng-dev \
    zip \
    unzip \
    git \
    nodejs \
    npm

# Install PHP extensions
RUN docker-php-ext-configure intl && \
    docker-php-ext-install -j$(nproc) \
    pdo_mysql \
    intl \
    zip \
    gd \
    bcmath

# Install composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY . .

# Install dependencies and build
RUN composer install --no-dev --optimize-autoloader && \
    npm install && \
    npm run build && \
    chown -R www-data:www-data storage bootstrap/cache

CMD ["php-fpm"]

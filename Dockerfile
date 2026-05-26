FROM php:8.2-cli

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    npm \
    libpq-dev

RUN docker-php-ext-install pdo pdo_mysql pdo_pgsql

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY . .

RUN composer install --no-dev --optimize-autoloader

RUN npm install

RUN npm run build

# Ensure storage directories exist and are writable
RUN mkdir -p storage/framework/sessions storage/framework/views storage/framework/cache/data storage/logs bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

RUN php artisan config:clear
RUN php artisan storage:link

EXPOSE 10000

CMD php artisan config:clear && php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=10000
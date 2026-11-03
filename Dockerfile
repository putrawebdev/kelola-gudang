FROM php:8.3-cli AS php-runtime

RUN apt-get update && apt-get install -y --no-install-recommends \
    git unzip curl libicu-dev libonig-dev libxml2-dev libzip-dev \
    && docker-php-ext-install -j"$(nproc)" \
        pdo_mysql mbstring bcmath intl xml zip pcntl \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

FROM php-runtime AS node-build
RUN apt-get update && apt-get install -y --no-install-recommends nodejs npm \
    && rm -rf /var/lib/apt/lists/*
WORKDIR /app
COPY package.json package-lock.json ./
RUN npm ci
COPY . .
RUN npm run build

FROM php-runtime AS app
WORKDIR /app

COPY . .
COPY --from=node-build /app/public/build ./public/build

RUN composer install --optimize-autoloader --no-dev --no-interaction \
    && php artisan storage:link --force || true \
    && mkdir -p storage/framework/{cache,sessions,views} storage/logs bootstrap/cache \
    && chmod -R ug+rwx storage bootstrap/cache

EXPOSE 8080

CMD ["sh", "-c", "php artisan migrate --force && php artisan db:seed --force && php artisan serve --host=0.0.0.0 --port=8080"]

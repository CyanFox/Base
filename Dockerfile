# syntax=docker/dockerfile:1

ARG PHP_VERSION=8.4

# Composer
FROM composer:2 AS vendor

WORKDIR /app

COPY artisan composer.json composer.lock* ./
COPY database/ database/
# The composer merge-plugin pulls in module composer.json files
COPY modules/ modules/

RUN --mount=type=cache,target=/tmp/cache \
    composer install \
        --no-dev \
        --no-scripts \
        --no-autoloader \
        --prefer-dist \
        --no-interaction \
        --no-progress \
        --ignore-platform-reqs

COPY app/ app/
COPY public/ public/
COPY resources/ resources/
COPY routes/ routes/
COPY lang/ lang/

RUN composer dump-autoload --optimize --no-dev --no-scripts --apcu

# Frontend
FROM node:22-alpine AS assets

WORKDIR /app

COPY package.json package-lock.json* ./
RUN --mount=type=cache,target=/root/.npm \
    npm ci --ignore-scripts

COPY vite.config.* vite-module-loader.js tailwind.config.* postcss.config.* ./
COPY resources/ resources/
COPY public/ public/
COPY lang/ lang/
COPY modules/ modules/

RUN npm run build

# Runtime
FROM php:${PHP_VERSION}-fpm-alpine AS runtime

LABEL org.opencontainers.image.source="https://git.cyanfox.de/CyanFox/Base"

# Runtime libraries
RUN set -eux; \
    apk add --no-cache --virtual .build-deps \
        $PHPIZE_DEPS \
        libzip-dev \
        libpng-dev \
        libjpeg-turbo-dev \
        freetype-dev \
        icu-dev \
        oniguruma-dev \
        postgresql-dev \
    && apk add --no-cache \
        caddy \
        icu-data-full \
        libzip \
        libpng \
        libjpeg-turbo \
        freetype \
        postgresql \
        libpq \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
        bcmath \
        exif \
        gd \
        intl \
        opcache \
        pcntl \
        pdo_mysql \
        pdo_pgsql \
        zip \
    && pecl install apcu redis \
    && docker-php-ext-enable apcu redis \
    && apk del .build-deps

# PHP configuration
RUN cp "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"
COPY docker/php.ini "$PHP_INI_DIR/conf.d/99-app.ini"

WORKDIR /app

# Application code
COPY --chown=www-data:www-data . .
COPY --from=vendor --chown=www-data:www-data /app/vendor ./vendor
COPY --from=assets --chown=www-data:www-data /app/public/build ./public/build
COPY docker/Caddyfile /etc/caddy/Caddyfile
COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh

# Production caches + permissions
RUN set -eux; \
    chmod +x /usr/local/bin/entrypoint.sh; \
    mkdir -p storage/framework/cache/data storage/framework/sessions storage/framework/testing storage/framework/views storage/logs bootstrap/cache database/database; \
    rm -f bootstrap/cache/*.php; \
    chown -R www-data:www-data storage bootstrap/cache database/database; \
    rm -rf /var/cache/apk/*

USER www-data

EXPOSE 8080

HEALTHCHECK --interval=30s --timeout=5s --start-period=20s --retries=3 \
    CMD nc -z 127.0.0.1 9000 || exit 1

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]

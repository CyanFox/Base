#!/bin/sh
set -e

[ -f bootstrap/cache/packages.php ] || php artisan package:discover --ansi

php-fpm -D

exec caddy run --config /etc/caddy/Caddyfile

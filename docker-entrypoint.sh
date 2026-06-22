#!/bin/bash
set -e

echo "==> Installing Composer dependencies..."
composer install --no-dev --optimize-autoloader --no-interaction

echo "==> Caching Laravel config & routes..."
php artisan config:cache
php artisan route:cache

echo "==> Running migrations..."
php artisan migrate --force

echo "==> Setting permissions..."
chown -R application:application /app/storage /app/bootstrap/cache
chmod -R 775 /app/storage /app/bootstrap/cache

echo "==> Starting Apache..."
exec /entrypoint supervisord

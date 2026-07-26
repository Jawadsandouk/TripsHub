#!/bin/bash
set -e

echo "==> Waiting for MySQL to be ready..."
until php -r "
    try {
        new PDO(
            'mysql:host=' . getenv('DB_HOST') . ';port=' . (getenv('DB_PORT') ?: '3306'),
            getenv('DB_USERNAME') ?: 'root',
            getenv('DB_PASSWORD') ?: 'root',
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );
        echo 'MySQL is ready!' . PHP_EOL;
        exit(0);
    } catch (PDOException \$e) {
        echo 'Waiting for MySQL...' . PHP_EOL;
        exit(1);
    }
" 2>/dev/null; do
    sleep 2
done

echo "==> Starting php-fpm in background..."
php-fpm &

echo "==> Installing Composer dependencies..."
composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev

echo "==> Creating directories..."
mkdir -p /var/www/html/storage/framework/views
mkdir -p /var/www/html/storage/framework/sessions
mkdir -p /var/www/html/storage/framework/cache/data
mkdir -p /var/www/html/bootstrap/cache

echo "==> Fixing permissions..."
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

echo "==> Creating storage symlink..."
php artisan storage:link --force

echo "==> Clearing caches..."
php artisan config:clear || true
php artisan route:clear || true

echo "==> Setup complete. Waiting for php-fpm..."
wait

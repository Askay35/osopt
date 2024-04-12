#!/bin/bash

set -e
echo "Deploying..."
git pull origin main
composer install --no-dev --optimize-autoloader -n
php artisan down
php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan event:cache
php artisan view:cache
php artisan up
echo "Deploy ended!"

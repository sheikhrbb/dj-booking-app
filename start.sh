#!/bin/bash

# Copy .env if not exists
if [ ! -f ".env" ]; then
  cp .env.example .env
fi

# Run Laravel setup
php artisan key:generate
php artisan config:cache
php artisan migrate --force

# Set correct permissions
chown -R www-data:www-data /var/www/html
chmod -R 775 storage bootstrap/cache

# Start Apache server
apache2-foreground

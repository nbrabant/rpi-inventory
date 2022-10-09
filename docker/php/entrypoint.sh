#!/bin/bash

echo "Running Migrations"
/scripts/wait-for-it.sh -t 60 database-rpi:3306
cd /var/www/app && php artisan migrate:refresh --seed

echo "Starting php-fpm..."
/usr/local/sbin/php-fpm -F

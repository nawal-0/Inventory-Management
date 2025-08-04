#!/bin/sh

# things to do before running the application
# install dependencies
composer install

# set permissions
chown -R www-data:www-data storage bootstrap/cache
chmod -R 775 storage bootstrap/cache

# copy .env.example to .env if .env does not exist
if [ ! -f .env ]; then
    cp .env.prod .env
fi

# generate application key
php artisan key:generate
php artisan storage:link

# run migrations and seed the database
php artisan migrate:fresh --seed

exec "$@"



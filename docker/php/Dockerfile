FROM php:8.1-fpm

COPY docker/php/xdebug /xdebug

RUN apt update && apt install -y zlib1g-dev g++ git libicu-dev zip libzip-dev libmagickwand-dev libmagickcore-dev sendmail  zlib1g-dev zip nodejs npm \
    && docker-php-ext-install intl opcache pdo pdo_mysql \
    && pecl install apcu \
    && pecl install imagick \
    && pecl install xdebug \
    && docker-php-ext-enable apcu \
    && docker-php-ext-enable imagick \
    && docker-php-ext-configure zip \
    && docker-php-ext-install gd \
    && docker-php-ext-install zip \
    && docker-php-ext-enable xdebug

WORKDIR /var/www/app

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy existing app directory contents to the working directory
COPY . /var/www/app
COPY /.env.example /var/www/app/.env
RUN composer update
# --ignore-platform-reqs --prefer-dist --no-scripts --no-progress --no-interaction --no-dev --no-autoloader --ignore-platform-reqs --no-scripts
RUN composer install
RUN composer dump-autoload --optimize --apcu
RUN php artisan key:generate
RUN chmod 777 -R storage bootstrap/cache

# Assign permissions of the working directory to the www-data user
RUN chown -R www-data:www-data /var/www/app/storage
RUN chown -R www-data:www-data /var/www/app/bootstrap/cache

RUN touch /var/www/app/storage/logs/laravel.log
RUN chmod 777 /var/www/app/storage/logs/laravel.log

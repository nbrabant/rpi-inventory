# RPI-inventory

Manage pantry, edit meals of the week and organize your week's shopping list

## Installation

### Local installation

#### Requirement

- PHP 7.4 or highter
- Composer
- MySQL 
- Nginx / Apache 2
- Node + NPM 

#### Install project

First step, install PHP dependencies with composer and Node packages with NPM

```shell script
composer install
npm install
```

Next step, you should configure the `.env` file. To start, you should just 
copy .env.example to .env

If you have Trello account and you want to add the Trello export functionality, please, use configuration panel to define Trello credentials

#### Install database

Sample data are pre-installed, to install database and this datas, execute the command :

```shell script
php artisan migrate:refresh --seed
```

#### Launch project

In two separate terminal, launch the commands below :

```shell script
php artisan serve
```

and

```shell script
npm run-script watch-poll
```

## Run with Docker 🐋

1. Clone the project
```
git clone https://github.com/nbrabant/rpi-inventory
```
2. build with docker compose
```
docker-compose up -d --build
```
3. Install the dependencies and the node packages into the container
```
make install
```
4. Generate Artisan APP_KEY
```
make generate_key
```
5. Build assets and run php artisan socket
```
make run-npm
make run-php
```
6. Run the app on your **localhost:8080**

## XDebug

If you want to use xdebug for debugging you have to start it with (running on port 9003):

```shell script
make xdebug-auto
```

There are also some other xdebug configs you can use:
- on (start_with_request false)
- profile (for profiling: profiling result will be saved at storage/logs)
- auto (start_with_request true)
- off (to deactivate xdebug)

If you want to see the differences of those config, check them out. You can find them in
docker/php/xdebug

#### IDE Config for XDebug
Depending on your IDE you need so setup some smaller things.

- PHPStorm: 
    - Settings > PHP > Debug > Debug port: 9003
    - Settings > PHP > Servers > add server with name "php-rpi" with path mappings. You need to map your project root to "/var/www/app"


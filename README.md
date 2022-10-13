# RPI-inventory

Manage pantry, edit meals of the week and organize your week's shopping list

## Local installation on Host (not recommended)

#### Requirements

- PHP 8.1
- Composer
- MySQL
- Node + NPM 

#### Install project

First step, install PHP dependencies with composer and Node packages with NPM

```shell script
composer install
npm install
```

Next step, you should configure the `.env` file. To start,
you should just copy .env.example to .env
When you run the application on your host (without docker)
thats the point where you need to configure the correct 
env variables for your local database.

If you have Trello account and you want to add the Trello
export functionality, please, use configuration panel to
define Trello credentials

#### Seed database

Sample data are pre-installed, to install database and
this datas, execute the command :

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

Open up browser and start the app calling **http://localhost:8000**

## Run with Docker 🐋 (recommended)

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
**(optional step for Windows DEV's when running in WSL)**

setup storage permissions
```
sudo chmod 777 -R storage/
```
4. Generate Artisan APP_KEY
```
make generate_key
```
5. Seed database
```
make db-refresh
```
6. Build assets with "watch" option. After executing this
you need to let the cli open as npm watch module needs to
watch for filechanges.
```
make run-npm
```
7. Open up browser and start the app calling **http://localhost:8080**

## Debugging PHP with XDebug

If you want to use xdebug for debugging you have to start it with (running on port 9003):

```shell script
make xdebug-auto
```

There are also some other xdebug configs you can use:
- `xdebug-on` (start_with_request false)
- `xdebug-profile` (for profiling: profiling result will be saved at storage/logs)
- `xdebug-auto` (start_with_request true)
- `xdebug-off` (to deactivate xdebug)

If you want to see the differences of those config, check them out. You can find them in
docker/php/xdebug

#### IDE Config for XDebug
Depending on your IDE you need so setup some smaller things.

- PHPStorm: 
    - Settings > PHP > Debug > Debug port: 9003
    - Settings > PHP > Servers > add server with name "php-rpi" with path mappings. You need to map your project root to "/var/www/app"


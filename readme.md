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

Next step, you should configure the `.env` file :

```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=homestead
DB_USERNAME=homestead
DB_PASSWORD=secret
```

If you have Trello account and you want to add the Trello export functionnality, please, add following Trello section

```dotenv
TRELLO_KEY=my_trello_key
TRELLO_TOKEN=my_trello_token
TRELLO_SECRET=my_trello_secret
TRELLO_REDIRECT_URI=my_trello_redirect_uri
TRELLO_BOARD=my_trello_board
TRELLO_LIST=my_trello_list
```

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
3. Install the dependencies into the container
```
docker exec -it php-rpi composer update (update until lock dependencies gets updated)
docker exec -it php-rpi composer dump-autoload
```
4. Generate Artisan APP_KEY
```
docker exec -it php-rpi php artisan key:generate
```
5. Install node packages and Build assets
```
docker exec -it php-rpi npm install
docker exec -it php-rpi npm run watch
```
6. Run the app on your **localhost:8080**
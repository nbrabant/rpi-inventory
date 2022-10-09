install: ## Install PHP and NPM dependencies
	docker exec -it php-rpi composer install && docker exec -it php-rpi npm install

build-php: ## build php docker image
	docker-compose build php-rpi

up: ## start application containers
	docker-compose up -d

down: ## stop application containers
	docker-compose down

generate_key: ## Generate Laravel APP_KEY
	docker exec -it php-rpi php artisan key:generate

db-migrate: ## run migrations
	docker exec -it php-rpi php artisan migrate

db-refresh: ## Reset and reinstall DB and datas
	docker exec -it php-rpi php artisan migrate:refresh --seed

config-clear: ## Clear the config cache
	docker exec -it php-rpi php artisan config:clear

test: ## Launch unit tests
	docker exec -it php-rpi ./vendor/bin/phpunit

run-npm: ## build and run front
	docker exec -it php-rpi npm run watch

run-php: ## run php socket
	docker exec -it php-rpi php artisan serve

bash-fpm: ## run a bash exec for fpm
	docker exec -it php-rpi bash

bash-mariadb: ## run a bash exec for mysql
	docker exec -it database-rpi bash

xdebug-auto:
	docker/scripts/xdebug.sh auto
xdebug-on:
	docker/scripts/xdebug.sh on
xdebug-profile:
	docker/scripts/xdebug.sh profile
xdebug-off:
	docker/scripts/xdebug.sh off

.PHONY: install generate_key db-refresh test run-npm run-php config-clear logs-fpm xdebug-auto xdebug-on xdebug-profile xdebug-off

help:
	@grep -E '(^[a-zA-Z_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) \
		| awk 'BEGIN {FS = ":.*?## "}; {printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}' \
		| sed -e 's/\[32m##/[33m/'
.PHONY: help

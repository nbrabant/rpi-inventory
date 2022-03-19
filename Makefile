install: ## Install PHP and NPM dependencies
	docker exec -it php-rpi composer install && docker exec -it php-rpi npm install

generate_key: ## Generate Laravel APP_KEY
	docker exec -it php-rpi php artisan key:generate

db-install: ## install DB
	docker exec -it php-rpi php artisan migrate

db-seed: ## install datas
	docker exec -it php-rpi php artisan migrate

db-refresh: ## Reset and reinstall DB and datas
	docker exec -it php-rpi php artisan migrate:refresh --seed

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

.PHONY: install generate_key db-refresh test run-npm run-php

help:
	@grep -E '(^[a-zA-Z_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) \
		| awk 'BEGIN {FS = ":.*?## "}; {printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}' \
		| sed -e 's/\[32m##/[33m/'
.PHONY: help
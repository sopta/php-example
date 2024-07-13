.PHONY: up down composer-install phpstan k6 test

up:
	docker compose up

down:
	docker compose down

composer-install:
	docker compose run --rm composer install

phpstan:
	docker compose run --rm phpstan analyse --level max app tests

k6:
	docker compose run --rm k6 --vus 10 --duration 30s /scripts/test.js

test:
	docker compose run --rm cli vendor/bin/pest
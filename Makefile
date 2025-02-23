.PHONY: up down composer-install phpstan k6 test migrate seed

up:
	docker compose up -d

down:
	docker compose down

composer-install:
	docker compose run --rm cli composer install

phpstan:
	docker compose run --rm cli vendor/bin/phpstan analyse --level max app tests

k6:
	docker compose run --rm k6 --vus 10 --duration 30s /scripts/test.js

test:
	docker compose run --rm cli vendor/bin/pest

migrate:
	docker compose run --rm cli bin/astronaut migrate

seed:
	docker compose run --rm cli bin/astronaut seed
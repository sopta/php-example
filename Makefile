.PHONY: up down composer-install phpstan k6

up:
	docker compose up

down:
	docker compose down

composer-install:
	docker compose run --rm composer install

phpstan:
	docker compose run --rm phpstan analyse --level max app

k6:
	docker compose run --rm k6 --vus 10 --duration 30s /scripts/test.js
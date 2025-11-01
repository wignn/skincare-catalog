docker-run:
	docker compose up -d


docker-run-prod:
	sudo docker compose up -d


run-php:
	php artisan serve

run-vite:
	npm run dev

mysql-console:
	sudo docker exec -it skincare-catalog-db-1 bash
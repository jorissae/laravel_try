EXEC = docker compose exec www
CONSOLE = $(EXEC) php project/artisan

bash:
	$(EXEC) bash

start: ## Start the project
	docker compose up -d

stop: ## Stop the project
	docker compose down --remove-orphans

npm:
	docker compose run www nvm install 20
	docker compose run www npm run build

cc:
	 $(CONSOLE) cache:clear

rebuild:
	docker compose down --remove-orphans
	docker compose pull
	docker compose build --no-cache
	docker compose up -d

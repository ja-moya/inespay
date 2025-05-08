COMPOSE=docker compose
SERVICE=app

.PHONY: start stop shell exec

start:
	$(COMPOSE) up -d --build

stop:
	$(COMPOSE) down

shell:
	$(COMPOSE) run --rm $(SERVICE) sh

exec:
	$(COMPOSE) run --rm $(SERVICE) $(filter-out $@,$(MAKECMDGOALS))

# Esto evita que 'exec' intente ejecutarse como objetivo real
%:
	@:

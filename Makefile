COMPOSE=docker compose
SERVICE=app
PHPUNIT=vendor/bin/phpunit

.PHONY: start stop shell exec

start:
	$(COMPOSE) up -d --build
	@echo "🔍 Verificando dependencias..."
	@if [ ! -d vendor ]; then \
		echo "📦 Ejecutando composer install..."; \
		$(COMPOSE) run --rm $(SERVICE) composer install; \
	else \
		echo "✅ Dependencias ya instaladas."; \
	fi

stop:
	$(COMPOSE) down

shell:
	$(COMPOSE) run --rm $(SERVICE) sh

exec:
	$(COMPOSE) run --rm $(SERVICE) $(filter-out $@,$(MAKECMDGOALS))

test:
	$(COMPOSE) run --rm $(SERVICE) $(PHPUNIT) --exclude-group integration

test-coverage:
	@echo "📊 Ejecutando cobertura solo con tests unitarios..."
	$(COMPOSE) run --rm $(SERVICE) sh -c "\
		XDEBUG_MODE=coverage \
		vendor/bin/phpunit \
		--exclude-group integration \
		--coverage-text \
		--coverage-filter=src \
	"

test-integration: start
	@echo "🔧 Iniciando servidor de pruebas dentro del contenedor..."
	-$(COMPOSE) exec -T $(SERVICE) sh -c 'php -S 0.0.0.0:8081 tests/server.php > /dev/null 2>&1 &'
	@sleep 1
	@echo "🧪 Ejecutando tests de integración..."
	-$(COMPOSE) exec -T $(SERVICE) $(PHPUNIT) --group integration --testdox
	@echo "🧹 Deteniendo servidor..."
	-$(COMPOSE) exec -T $(SERVICE) sh -c 'kill $$(ps -ef | grep "[p]hp -S 0.0.0.0:8081" | awk '\''{print $$2}'\'' ) || true'


# Esto evita que 'exec' intente ejecutarse como objetivo real
%:
	@:

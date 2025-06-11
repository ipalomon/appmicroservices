# Variables docker-compose build, docker-compose up -d --build
COMPOSE = docker-compose
PHP = $(COMPOSE) exec web php
CONSOLE = $(PHP) bin/console
COMPOSER = $(COMPOSE) exec web composer

.DEFAULT_GOAL := help

help:  ## Muestra este menú de ayuda
	@echo ""
	@echo "Comandos disponibles:"
	@echo "  make up              🔧 Construye y levanta el entorno Docker"
	@echo "  make down            🧹 Detiene y elimina contenedores"
	@echo "  make restart         ♻️  Reinicia el entorno Docker"
	@echo "  make install         📦 Instala dependencias PHP con Composer"
	@echo "  make migrate         📄 Ejecuta migraciones de base de datos"
	@echo "  make cache-clear     🧽 Limpia la caché de Symfony"
	@echo "  make bash            🐚 Accede al contenedor web (bash)"
	@echo "  make db              🐘 Accede al contenedor de base de datos"
	@echo "  make logs            📜 Muestra los logs en tiempo real"
	@echo "  make test            🧪 Ejecuta tests con PHPUnit"
	@echo ""

# Comandos Docker
up:  ## Construye y levanta el entorno Docker
	$(COMPOSE) up -d --build

down:  ## Detiene y elimina contenedores
	$(COMPOSE) down

restart:  ## Reinicia el entorno Docker
	$(COMPOSE) down && $(COMPOSE) up -d

# Composer y Symfony
install:  ## Instala dependencias PHP con Composer
	$(COMPOSER) install

migrate:  ## Ejecuta migraciones de base de datos
	$(CONSOLE) doctrine:migrations:migrate --no-interaction

cache-clear:  ## Limpia la caché de Symfony
	$(CONSOLE) cache:clear

# Acceso a contenedores
bash:  ## Accede al contenedor web (bash)
	$(COMPOSE) exec web bash

db:  ## Accede al contenedor de base de datos
	$(COMPOSE) exec db bash

# Logs y pruebas
logs:  ## Muestra los logs en tiempo real
	$(COMPOSE) logs -f

test:  ## Ejecuta tests con PHPUnit
	$(PHP) bin/phpunit

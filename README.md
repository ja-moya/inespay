# 💡 Sistema de Notificaciones · PHP 8.2 · Arquitectura Hexagonal

Este proyecto implementa un sistema de notificaciones usando arquitectura hexagonal en PHP 8.2.  
Envía entidades `Payment` vía HTTP POST con firma JWT y permite testear tanto unitariamente como con integración real.

---

## 🧰 Requisitos

- Docker
- Docker Compose
- GNU Make

---

## 📦 Instalación y arranque del entorno

```bash
make start        # Levanta el contenedor Docker de desarrollo
make stop         # Lo detiene y elimina
```

---

## 🖐 Ejecutar `hello.php`
hello.php es un código que maneja una entidad Payload y la envía en un POST con JWT.
```bash
make exec php hello.php
```

También puedes hacerlo manualmente desde dentro del contenedor:

```bash
make shell
php hello.php
```

---

## ✅ Ejecutar tests unitarios

```bash
make test
```

Esto ejecuta solo los tests **que no están marcados como `@group integration`**.

---

## 🧪 Ejecutar tests de integración

```bash
make test-integration
```

Este comando:

1. Levanta el servidor de pruebas (`php -S`) en el contenedor.
2. Ejecuta los tests que requieren ese servidor (marcados con `@group integration`).
3. Mata el servidor tras finalizar los tests.

---

## 📊 Ver cobertura de código

```bash
make test-coverage
```

Esto lanza los tests **unitarios** con `Xdebug` y muestra la cobertura directamente en consola.

---

## 📂 Estructura del proyecto

```
.
├── src/                         # Código principal (arquitectura hexagonal)
├── tests/
│   ├── SharedContext/...       # Tests unitarios
│   ├── PaymentContext/...      # Tests específicos del dominio
│   ├── server.php              # Servidor mock para integración
│   └── last_request.json       # Dump del último request recibido (para testeo)
├── hello.php                   # Script de ejemplo
├── docker/                     # Configuración Docker/Xdebug
├── Dockerfile                  # Imagen base de desarrollo
├── Makefile                    # Tareas automatizadas
├── phpunit.xml                 # Configuración de PHPUnit con cobertura
```

---

## 🧹 Limpieza del entorno

```bash
make stop
```

Esto elimina los contenedores y redes usadas por el proyecto.

---

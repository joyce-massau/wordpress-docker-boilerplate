# WordPress Docker Boilerplate

A reusable boilerplate for building **WordPress** projects with **Docker Compose**, featuring isolated **development** and **production** environments.

This repository serves as a starting point for new WordPress projects by providing a standardized, reproducible, and production-ready development workflow.

---

# Features

* WordPress 7.0.2 (PHP 8.2 + Apache)
* MariaDB 11.8 (LTS)
* Adminer
* Docker Compose
* Separate development and production environments
* Version-controlled custom plugins and themes
* Production-ready Docker image
* Environment-based configuration
* Immutable infrastructure approach

---

# Project Structure

```text
.
├── docker-compose.yml
├── docker-compose.dev.yml
├── docker-compose.prod.yml
├── Dockerfile
├── .env.example
├── .env.dev
├── .env.prod
├── src/
│   ├── plugins/
│   └── themes/
└── README.md
```

---

# Project Architecture

This project separates **application code** from **runtime data**.

## Versioned

* Docker configuration
* Dockerfile
* Custom plugins
* Custom themes
* Infrastructure configuration

## Not Versioned

* Database
* Uploaded media
* Cache
* Backups
* Environment variables

This allows the application to be rebuilt and deployed consistently across multiple environments.

---

# Docker Compose Files

## docker-compose.yml

Contains configuration shared by every environment:

* WordPress
* MariaDB
* Adminer
* Docker network
* Environment variables
* Persistent volumes

---

## docker-compose.dev.yml

Development-only configuration:

* Published ports
* Bind mounts
* Live plugin/theme development
* Database access from host

---

## docker-compose.prod.yml

Production-only configuration:

* Published HTTP port
* Persistent uploads volume
* Persistent database volume

No plugin or theme bind mounts are used in production.

---

# Environment Variables

This project uses different `.env` files for each environment.

## Development

```bash
docker compose \
  --env-file .env.dev \
  -f docker-compose.yml \
  -f docker-compose-dev.yml \
  up -d
```

## Production

```bash
docker compose \
  --env-file .env.prod \
  -f docker-compose.yml \
  -f docker-composeprod.yml \
  up -d
```

---

# Environment Files

Use `.env.example` as the base configuration.

Example:

```env
#####################################
# MariaDB
#####################################

MARIADB_ROOT_PASSWORD=
MARIADB_DATABASE=
MARIADB_USER=
MARIADB_PASSWORD=

#####################################
# WordPress
#####################################

WP_ENVIRONMENT_TYPE=development
```

Create one file for each environment:

* `.env.dev`
* `.env.prod`

These files should **never** be committed to Git.

---

# Production Workflow

Development:

* Plugins can be installed
* Themes can be installed
* Plugin editor enabled
* Theme editor enabled
* Debug mode enabled

Production:

* Plugins cannot be installed
* Themes cannot be installed
* File editor disabled
* Debug mode disabled

The project uses:

```php
define('DISALLOW_FILE_MODS', true);
```

to prevent changes through the WordPress Admin Dashboard.

Application changes should always be deployed through Git and Docker.

---

# Data Persistence

## MariaDB

The database stores:

* Posts
* Pages
* Users
* Comments
* Menus
* Widgets
* Settings

---

# Updating WordPress

Update the WordPress version by changing the image tag in the Docker configuration.

Rebuild the project:

```bash
docker compose build
docker compose up -d
```

---

# Recommended Deployment Flow

```text
Develop
    │
    ▼
Commit
    │
    ▼
Build Docker Image
    │
    ▼
Push Image to Registry
    │
    ▼
Pull Image on Server
    │
    ▼
docker compose up -d
```

No manual file transfers or FTP deployments are required.

---

# Git Ignore

The following files and directories should not be committed:

* `.env`
* `.env.*`
* `backups/`
* Uploaded media
* Cache
* IDE configuration
* Operating system files

---

# Repository Purpose

This repository provides a reusable foundation for creating new WordPress projects with Docker.

Its goals are:

* Standardized project structure
* Clean separation between development and production
* Reproducible infrastructure
* Version-controlled plugins and themes
* Simple deployment workflow
* Easy maintenance and scalability

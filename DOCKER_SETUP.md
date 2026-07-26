# Running TripsHub with Docker

## Prerequisites

- [Docker](https://docs.docker.com/get-docker/) (v20.10+)
- [Docker Compose](https://docs.docker.com/compose/install/) (v2.0+)

---

## Quick Start

```bash
# 1. Clone/navigate to the project directory
cd TripsHubDockerVersion

# 2. Build and start all containers
docker-compose up -d --build

# 3. Watch the logs (wait for "Starting php-fpm..." message)
docker-compose logs -f app
```

The first run will:
- Build the PHP-FPM image with all extensions
- Import `tripshub1.sql` into MySQL (database: `tripshub1`)
- Install Composer dependencies
- Create the `storage:link` symlink

---

## Access Points

| Service | URL |
|---------|-----|
| **Laravel App** | http://localhost:8000 |
| **phpMyAdmin** | http://localhost:8080 |

### phpMyAdmin Login
- **Server**: `mysql`
- **Username**: `root`
- **Password**: `root`

---

## Common Commands

```bash
# Start containers
docker-compose up -d

# Stop containers
docker-compose down

# Rebuild after Dockerfile changes
docker-compose up -d --build

# View logs
docker-compose logs -f app
docker-compose logs -f mysql
docker-compose logs -f nginx

# Open a shell in the app container
docker-compose exec app bash

# Run Laravel artisan commands
docker-compose exec app php artisan <command>

# Run database migrations (if needed)
docker-compose exec app php artisan migrate --force

# Clear all caches
docker-compose exec app php artisan optimize:clear
```

---

## Re-importing the Database

MySQL only imports the SQL file on first startup. To re-import:

```bash
# Destroy the MySQL volume and start fresh
docker-compose down -v
docker-compose up -d --build
```

---

## Troubleshooting

### "Connection refused" errors
MySQL may still be starting up. Wait a few seconds and check:
```bash
docker-compose ps
docker-compose logs mysql
```

### App container exits immediately
Check the entrypoint logs:
```bash
docker-compose logs app
```

### Permission errors on storage/
Fix manually:
```bash
docker-compose exec app chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
```

### Port 8000 already in use
Change the port in `docker-compose.yml`:
```yaml
ports:
  - "8001:80"   # change 8000 to 8001
```
Also update `APP_URL` in `.env` to `http://localhost:8001`.

### MySQL data persists after import
The `mysql_data` volume keeps data between restarts. To wipe and re-import:
```bash
docker-compose down -v
docker-compose up -d
```

---

## Services Overview

```
┌──────────────┐     ┌──────────────┐     ┌──────────────┐
│    Nginx     │────▶│   PHP-FPM    │────▶│    MySQL     │
│  :8000 → 80  │     │  (app:9000)  │     │  :3307→3306  │
└──────────────┘     └──────────────┘     └──────────────┘
                                             ▲
                                        tripshub1.sql
                                     (auto-imported)
                          ┌──────────────┐
                          │  phpMyAdmin  │
                          │    :8080     │
                          └──────────────┘
```

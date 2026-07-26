# Docker Configuration Fixes

## Summary of Changes

This document describes all fixes applied to the Docker configuration to make the Laravel project run correctly in containers.

---

## 1. `.env` — Environment Variables

| Variable | Before | After | Why |
|----------|--------|-------|-----|
| `DB_HOST` | `127.0.0.1` | `mysql` | Must use the Docker service name, not localhost (which refers to the container itself) |
| `DB_PASSWORD` | *(empty)* | `root` | Must match `MYSQL_ROOT_PASSWORD` in docker-compose.yml |
| `APP_URL` | `http://localhost` | `http://localhost:8000` | Nginx maps port 8000 on the host to port 80 in the container |
| `APP_DEBUG` | `false` | `true` | Enables detailed error pages for local development |

---

## 2. `Dockerfile` — PHP-FPM Image

### Changes:
- **Added `bcmath` extension** — required by Laravel for mathematical operations
- **Added `apt lists cleanup** (`rm -rf /var/lib/apt/lists/*`) — reduces image size
- **Added `entrypoint.sh`** — copied into the container and set as the entrypoint
- **Improved permissions** — `chown` runs during build for faster container startup

### Why the entrypoint is needed:
The volume mount (`./:/var/www/html`) in docker-compose overrides the `COPY . .` in the Dockerfile. This means Composer dependencies installed during `docker build` are lost when the container starts. The entrypoint script runs `composer install` on every container start to solve this.

---

## 3. `docker-compose.yml` — Service Orchestration

### MySQL Service
| Change | Details |
|--------|---------|
| **SQL import** | Added `./tripshub1.sql:/docker-entrypoint-initdb.d/tripshub1.sql` — MySQL automatically runs `.sql` files in this directory on first start |
| **Healthcheck** | Added `mysqladmin ping` healthcheck so dependent services wait for MySQL to be truly ready |

### App Service
| Change | Details |
|--------|---------|
| **`env_file: .env`** | Ensures the container reads the corrected `.env` file |
| **`depends_on` with condition** | Uses `condition: service_healthy` to wait for MySQL healthcheck before starting |

### Nginx Service
| Change | Details |
|--------|---------|
| No changes needed | Already correctly configured to proxy to `app:9000` |

---

## 4. `docker/entrypoint.sh` — New File

A startup script that runs before php-fpm:

1. **Waits for MySQL** — polls with PDO until the database accepts connections
2. **Installs Composer dependencies** — handles the volume-mount override issue
3. **Fixes permissions** — ensures `www-data` owns `storage/` and `bootstrap/cache/`
4. **Creates `storage:link`** — symlinks `public/storage` → `storage/app/public`
5. **Clears caches** — removes stale config/route/view caches
6. **Starts php-fpm** — hands off to the main process

---

## 5. Database Import

The SQL file `tripshub1.sql` is mounted into MySQL's initialization directory:
```
./tripshub1.sql:/docker-entrypoint-initdb.d/tripshub1.sql
```

**Important**: MySQL only runs init scripts on **first start** (when the `mysql_data` volume is empty). To re-import:
```bash
docker-compose down -v    # removes the volume
docker-compose up -d      # fresh start with SQL import
```

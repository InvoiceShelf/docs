---
versions: ['3']
reviewed_against: c4f6f8af2163fcc3a0c97d2046fcf22c1d47d0e7
reviewed_hash: 5db592be77d1dbb34411b38354853d2fb18c3198f469063f5733eac93b5fd96e
anchor_aliases:
  step-1-install-docker: prepare-compose
  step-2-clone-repository: prepare-compose
  step-3-prepare-docker-compose: prepare-compose
  _3-1-configure-your-public-address: prepare-compose
  app-url: prepare-compose
  session-domain: prepare-compose
  sanctum-stateful-domains: prepare-compose
  trusted-proxies: prepare-compose
  step-4-finalize-run-docker-compose: prepare-compose
  step-5-complete-installation-wizard: prepare-compose
  _5-1-mariadb-postgresql: prepare-compose
  _5-2-sqlite-database: prepare-compose
---

# Docker installation

Use the official image pinned to **3.0.0-alpha.10**. The `next` tag tracks the moving v3 preview; this guide pins the alpha so the instructions remain reproducible.

## Prepare Compose

Install Docker Engine with its Compose plugin. Create a new empty deployment directory and save this as `compose.yaml` for a local SQLite installation:

```yaml
services:
  invoiceshelf:
    image: invoiceshelf/invoiceshelf:3.0.0-alpha.10
    ports:
      - "127.0.0.1:8090:8080"
    environment:
      APP_ENV: production
      APP_DEBUG: "false"
      APP_URL: http://localhost:8090
      DB_CONNECTION: sqlite
      DB_DATABASE: /var/www/html/storage/app/database.sqlite
      CACHE_STORE: file
      SESSION_DRIVER: file
      SESSION_DOMAIN: localhost
      SANCTUM_STATEFUL_DOMAINS: localhost:8090
      PHP_TZ: UTC
    volumes:
      - storage:/var/www/html/storage
      - modules:/var/www/html/Modules
volumes:
  storage:
  modules:
```

The loopback port is a local example. For a public server, put an HTTPS reverse proxy in front and change `APP_URL` to the public URL. Set `SESSION_DOMAIN` to its hostname without a scheme or port, and `SANCTUM_STATEFUL_DOMAINS` to the browser host, including a nonstandard port if used. Trust only the proxy addresses that should supply forwarded headers.

## Start and finish setup

```bash
docker compose up -d
docker compose logs --tail=100 invoiceshelf
```

Open `http://localhost:8090` and follow the installer. Keep the SQLite database on the mounted storage path. If you use MySQL, MariaDB or PostgreSQL instead, configure that service and its database credentials before the wizard; the database must be reachable from the application container.

## Verify persistence

Create a test document, restart the application container, and confirm it is still present and its PDF renders. Preserve the volumes, application key and deployment configuration. `docker compose down --volumes` deletes named volumes and is not an ordinary restart command.

## Updates

Take and restore-test a backup, read the target release notes, then deliberately change the image tag. Verify the update on a copy first. Follow [migration and updates](../migration-guide.md) for the version boundary; replacing the image alone is not a tested rollback of a migrated database.

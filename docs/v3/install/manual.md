---
versions: ['3']
reviewed_against: c4f6f8af2163fcc3a0c97d2046fcf22c1d47d0e7
reviewed_hash: b89535254c7de7e5e5096eca15c6b657e83924fce704cf722fa43227be42cd45
anchor_aliases:
  step-1-download: requirements
  step-2-upload-to-server: requirements
  step-3-point-the-domain-to-the-uploaded-folder: requirements
  step-4-fix-file-permissions: requirements
  step-5-copy-environment-file: configure-the-environment
  step-6-complete-installation-wizard: requirements
---

# Manual installation

This path is for operators who manage PHP, the database and a web server. The application’s document root must be its **`public/` directory**, never the repository root.

## Requirements

- PHP 8.4.1+ compatible with this release and Composer 2.
- The PHP extensions checked by the application installer and Composer, including the PDO driver for your database, mbstring, XML, curl, zip, fileinfo and image support.
- SQLite, MySQL/MariaDB or PostgreSQL configured for the application.
- Write access for the PHP user to `storage/` and `bootstrap/cache/`.
- Node.js 24+ and the pinned pnpm version only if you build from source.

## Obtain the application

Use the **3.0.0-alpha.10** application package from the [release page](https://github.com/InvoiceShelf/InvoiceShelf/releases/tag/3.0.0-alpha.10), or use the source build below. A GitHub-generated source archive is not the same as a prepared application package: it needs dependencies and compiled assets.

```bash
git clone --branch 3.0.0-alpha.10 --depth 1 https://github.com/InvoiceShelf/InvoiceShelf.git invoiceshelf
cd invoiceshelf
cp .env.example .env
composer install --no-dev --optimize-autoloader
corepack enable
pnpm install --frozen-lockfile
pnpm build
php artisan key:generate
```

Generate a key only for this new installation. Never overwrite the key of an existing database.

## Configure the environment

Set `APP_ENV=production`, `APP_DEBUG=false`, and the real `APP_URL`. Set the database connection and credentials. For SQLite, create a writable database file and set `DB_DATABASE` to its absolute path. Use a host-only session cookie unless your deployment specifically needs a wider cookie domain.

Set file ownership for your actual PHP service user; avoid world-writable permissions. The web server should serve static files from `public/` and route other requests to `public/index.php` through PHP-FPM. Keep environment files and storage internals outside the public document root.

## Complete the installer

Open the configured URL and complete the requirements, database, administrator and company steps. Confirm sign-in, create a test invoice and render a PDF. If the page has no styling, check `public/build/manifest.json` and the asset URLs.

Configure the [scheduler](../guide/recurring-invoices.md#server-configuration), [mail](../guide/mail.md) and [backups](../guide/backups.md). For a local Nginx configuration example, see [manual development](../developer/manual.md).

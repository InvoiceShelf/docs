---
versions: ['2']
reviewed_against: 0287adf6472dd4fe0f6f731c966afcd685086bdb
reviewed_hash: d64798d10c19e63717a1db20cb1b80c10239adb0d1dbe96f0177714e198560d5
anchor_aliases:
  setting-up-with-laravel-herd: create-the-workspace
  step-1-install-laravel-herd: create-the-workspace
  step-2-clone-the-repository: create-the-workspace
  step-3-set-up-environment-variables: create-the-workspace
  step-4-install-dependencies: create-the-workspace
  step-5-generate-application-key: create-the-workspace
  step-6-migrate-the-database: database-and-setup
  step-7-start-laravel-herd: create-the-workspace
  step-8-access-the-application: create-the-workspace
---

# Development with Laravel Herd

Herd can supply the local PHP runtime and web server. Select PHP 8.4+ compatible with this release, and install Composer, Node.js 24+ and pnpm. Use a local database supported by the application.

## Create the workspace

```bash
git clone --branch 2.4.6 --depth 1 https://github.com/InvoiceShelf/InvoiceShelf.git invoiceshelf-v2
cd invoiceshelf-v2
cp .env.example .env
composer install
corepack enable
pnpm install --frozen-lockfile
php artisan key:generate
pnpm build
```

Register the checkout as a site in Herd using its site manager. Confirm the detected Laravel document root is `public/`, then set `APP_URL` to the site’s actual URL. Use the same hostname consistently so session cookies and CSRF checks match.

## Database and setup

Configure a dedicated database in `.env`. For SQLite, create a writable file and provide its absolute path. Open the site and complete the browser installer. Do not run destructive reset commands on a database shared with another local project.

## Frontend work

Run `pnpm dev` while changing Vue files, or run `pnpm build` to inspect compiled output. If the page references a stopped Vite server, stop development mode cleanly and rebuild the production assets.

The application setup and dependency commands match the pinned source release; Herd’s platform-specific installation is managed by Herd. Check the PHP binary used by your terminal as well as the one selected for the site when Composer reports a runtime mismatch.

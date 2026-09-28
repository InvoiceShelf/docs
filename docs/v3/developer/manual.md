---
versions: ['3']
reviewed_against: c4f6f8af2163fcc3a0c97d2046fcf22c1d47d0e7
reviewed_hash: 9ff79ebd7b4ce3bec22b56d62f9bb567afb760ed4920786f26d37db27536496b
anchor_aliases:
  setting-up-with-nginx-php-fpm: development-with-nginx-and-php-fpm
  step-1-install-dependencies: prepare-the-application
  step-2-clone-the-repository: prepare-the-application
  step-3-set-up-environment-variables: prepare-the-application
  step-4-install-dependencies: prepare-the-application
  step-5-generate-application-key: prepare-the-application
  step-6-migrate-the-database: prepare-the-application
  step-7-configure-nginx: development-with-nginx-and-php-fpm
  step-8-access-the-application: prepare-the-application
---

# Development with Nginx and PHP-FPM

Use PHP 8.4.1+, Composer 2, Node.js 24+, pnpm and a database driver matching this release. The commands below create a new disposable source workspace.

## Prepare the application

```bash
git clone --branch 3.0.0-alpha.10 --depth 1 https://github.com/InvoiceShelf/InvoiceShelf.git invoiceshelf-v3
cd invoiceshelf-v3
cp .env.example .env
composer install
corepack enable
pnpm install --frozen-lockfile
php artisan key:generate
```

Set the local `APP_URL` and database settings in `.env`. For SQLite, create `database/database.sqlite` and use its absolute path. Keep the same key when restarting this workspace.

## Configure Nginx

Adapt the paths and PHP socket to your machine:

```nginx
server {
    listen 80;
    server_name invoiceshelf-v3.test;
    root /path/to/invoiceshelf-v3/public;
    index index.php;
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }
    location ~ \.php$ {
        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        fastcgi_pass unix:/run/php/php8.4-fpm.sock;
    }
    location ~ /\. {
        deny all;
    }
}
```

Map the chosen `.test` hostname to loopback and validate Nginx configuration before reloading it. Ensure the PHP service user can write `storage/` and `bootstrap/cache/`.

## Build and install

Run `pnpm build` for static assets or keep `pnpm dev` running for frontend development. Open the local URL and complete the installer. For an existing initialized development database, use `php artisan migrate` for pending migrations rather than repeating the setup wizard.

Verify login, an invoice PDF and local mail delivery. Use `php artisan schedule:work` only when testing scheduled behavior in this disposable environment.

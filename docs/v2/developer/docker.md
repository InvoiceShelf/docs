---
versions: ['2']
reviewed_against: 0287adf6472dd4fe0f6f731c966afcd685086bdb
reviewed_hash: f36287054dcab6f455bc6033d33a7ddc7a1d0e89ae475e03ac877d9804ada7d6
anchor_aliases:
  setting-up-with-docker: clone-the-correct-version
  step-1-clone-the-repository: clone-the-correct-version
  step-2-start-the-development-environment: start-the-development-environment
  step-3-install-application-dependencies: install-dependencies
  step-4-access-the-application: clone-the-correct-version
  useful-details: clone-the-correct-version
  a-working-with-composer-pnpm-and-tests: clone-the-correct-version
  b-previewing-the-database: clone-the-correct-version
  c-previewing-mail: clone-the-correct-version
---

# Development with Docker

The application repository includes a development helper for Linux and macOS. It is separate from the production Docker image and from the multi-repository InvoiceShelf/devenv workspace.

## Clone the correct version

```bash
git clone --branch 2.x https://github.com/InvoiceShelf/InvoiceShelf.git invoiceshelf-v2
cd invoiceshelf-v2
```

To reproduce this guide’s baseline exactly, check out tag `2.4.6` in a disposable checkout. Install Docker with Compose and Node.js 24+ on the host.

## Start the development environment

```bash
./devenv
```

Follow the helper’s database and optional Gotenberg prompts. It records the selected Compose configuration in `.devenvconfig`. Check the displayed host and ports; another development stack may already use them.

## Install dependencies

```bash
./devenv run composer install
./devenv run php artisan key:generate
corepack enable
pnpm install --frozen-lockfile
pnpm dev
```

The PHP command runs in the application container, while Vite runs on the host. Generate a key only for a new development environment. Complete the browser installer at the configured local hostname.

## Daily commands

Use `./devenv start`, `./devenv stop`, `./devenv logs` and `./devenv shell`. `./devenv run php artisan migrate` applies pending migrations to your development database. `./devenv test` runs the PHP tests; `./devenv format` runs the formatter.

Use the Mailpit and database-inspection endpoints exposed by the chosen Compose file for local checks. Keep development mail local and use fixtures instead of production customer records. Run `pnpm build` before checking the production asset output.

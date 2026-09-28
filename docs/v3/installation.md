---
versions: ['3']
reviewed_against: c4f6f8af2163fcc3a0c97d2046fcf22c1d47d0e7
reviewed_hash: f563a4b2f56ea9d351c360bec52815870014c6b901d39067a7ed68cbe3c38fe3
---

# Installation

This guide targets **3.0.0-alpha.10**. It is an alpha preview: use a separate test installation and keep production data on the stable line.

## Docker installation

Use [Docker](./install/docker.md) for the packaged application and its runtime. Pin the image tag so a restart does not silently select a different release. Persist storage and modules, configure your public address, then finish the browser wizard.

## Manual installation

Use the [manual guide](./install/manual.md) when you operate PHP and a web server yourself. You need PHP 8.4.1 or newer compatible with the release’s locked dependencies, a supported database connection, writable application storage, and a web root pointing at `public/`.

For a source-code workspace with frontend tooling, start with the [developer guide](./developer-guide.md). Development fixtures and seeded demonstration records should never be imported into production.

## After installation

Check [company preferences](./guide/settings.md), create a test customer and invoice, generate its PDF, and test [email](./guide/mail.md). Configure [backups](./guide/backups.md) and the [scheduler](./guide/recurring-invoices.md#server-configuration) before relying on recurring invoices.

Use HTTPS for a public installation. Keep `APP_URL` aligned with the address people actually use, and preserve the application key during future upgrades.

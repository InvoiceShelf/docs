---
versions: ['2']
reviewed_against: 0287adf6472dd4fe0f6f731c966afcd685086bdb
reviewed_hash: 18515d7183c2d277e1f4b2d9f50506ba8063b7cc1ffc2d8a1d98b37f948a1171
---

# Installation

This guide targets **2.4.6**. This is the stable v2 line. Keep up with security releases within that line.

## Docker installation

Use [Docker](./install/docker.md) for the packaged application and its runtime. Pin the image tag so a restart does not silently select a different release. Persist storage and modules, configure your public address, then finish the browser wizard.

## Manual installation

Use the [manual guide](./install/manual.md) when you operate PHP and a web server yourself. You need PHP 8.4 or newer compatible with the release’s locked dependencies, a supported database connection, writable application storage, and a web root pointing at `public/`.

For a source-code workspace with frontend tooling, start with the [developer guide](./developer-guide.md). Development fixtures and seeded demonstration records should never be imported into production.

## After installation

Check [company preferences](./guide/settings.md), create a test customer and invoice, generate its PDF, and test [email](./guide/mail.md). Configure [backups](./guide/backups.md) and the [scheduler](./guide/recurring-invoices.md#server-configuration) before relying on recurring invoices.

Use HTTPS for a public installation. Keep `APP_URL` aligned with the address people actually use, and preserve the application key during future upgrades.

---
versions: ['2']
reviewed_against: 0287adf6472dd4fe0f6f731c966afcd685086bdb
reviewed_hash: 856201b761e565852bc64653a0fbda6b56ea9e4843f8e3191683fb93f7b2efec
anchor_aliases:
  migration-guide: migration-and-updates
---

# Migration and updates

Use current v2 security releases for an existing v2 installation. A major-version migration has a wider scope than a patch update.

## Prepare a recoverable copy

Record the source version, database engine, installed modules and custom templates. Back up the database, storage, modules and environment configuration, including the existing application key. Restore them into an isolated environment and verify the copy before changing its version.

Disable outgoing mail and scheduled invoice generation in the rehearsal. A restored application can otherwise contact customers or generate duplicate invoices. Keep the original production installation untouched while testing.

## Apply an update in staging

Use the target release’s built package or build its locked dependencies, preserve your environment and persistent files, then apply the target migrations:

```bash
php artisan migrate --force
php artisan optimize:clear
```

Run these only in the intended restored installation. For Docker, use the application container’s PHP runtime and the selected target image. Read the target release notes for additional version-specific work before running commands.

Stay within the v2 line for routine maintenance. If evaluating v3, use the [v3 migration guide](/docs/v3/migration-guide) and a separate copy.

## Verify and roll back

Compare record counts and representative customer balances. Open old and new invoices, render PDFs, inspect uploaded receipts, and test the intended permissions. Enable mail and scheduling only after the correct installation is selected for use.

Rollback means restoring the pre-update database and files together with the matching application version and key. Do not point an older application at a database already migrated by a newer version.

## Moving from another product

A Crater or other-product database is not a versioned InvoiceShelf backup. Establish the exact source schema and a tested conversion path first. Do not replace a live InvoiceShelf database with it based on old rename-and-copy instructions.

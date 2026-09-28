---
versions: ['3']
reviewed_against: c4f6f8af2163fcc3a0c97d2046fcf22c1d47d0e7
reviewed_hash: 33ec6fd82a4fc31a541b4756361985c365bb092d15dd0567ff3c144f6a9e84b9
anchor_aliases:
  migration-guide: migration-and-updates
---

# Migration and updates

Version 3 is an alpha preview. Rehearse an upgrade on a separate restored copy; this guide does not recommend switching production invoicing to an alpha.

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

The v3 database and permissions model have changed. Check company membership, roles, document numbering, payment allocations, custom templates and module compatibility explicitly. An old module or template must not be assumed compatible because the database migration completes.

## Verify and roll back

Compare record counts and representative customer balances. Open old and new invoices, render PDFs, inspect uploaded receipts, and test the intended permissions. Enable mail and scheduling only after the correct installation is selected for use.

Rollback means restoring the pre-update database and files together with the matching application version and key. Do not point an older application at a database already migrated by a newer version.

## Moving from another product

A Crater or other-product database is not a versioned InvoiceShelf backup. Establish the exact source schema and a tested conversion path first. Do not replace a live InvoiceShelf database with it based on old rename-and-copy instructions.

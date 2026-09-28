---
versions: ['2']
reviewed_against: 0287adf6472dd4fe0f6f731c966afcd685086bdb
reviewed_hash: 24b63af614198bbbb3d92003068e0618dc22c4619de033f2b208cb2cc7432541
anchor_aliases:
  fields: backups
---

# Backups

Back up the database, uploaded files, custom templates and installation configuration before upgrades or server moves. Preserve the existing application key: generating a new key is not a restore procedure.

## Create a new backup

1. Open **Settings → Backup**.
2. Select **Add New Backup** and choose the available backup options and destination.
3. Wait for the operation to finish, then confirm the new archive appears in the list.
4. Copy it to a protected location independent of this server and test that it can be opened.

![InvoiceShelf 2 backup management](/images/v2/backups.webp)

The archive contains the configured included files and a database dump. Inspect its contents instead of assuming every external disk, environment file or custom server configuration is included. Remote object storage may require a separate backup policy.

## Restore rehearsal

Restore into a separate installation with the matching application version, database engine and configuration. Keep mail and scheduled document generation disabled during the rehearsal so a restored copy cannot send duplicate customer messages or invoices.

Verify sign-in, company data, customer totals, invoice PDFs and attached receipts. A downloadable archive is only useful when this restore test succeeds. Keep the original server and a pre-upgrade copy until the restored installation is validated.

## Scheduling and retention

The backup screen does not replace an operational schedule and retention policy. If you automate Laravel backup commands, run them as the application user, monitor failures, and protect the destination credentials. In Docker, back up the persistent volumes and database rather than the container’s writable layer.

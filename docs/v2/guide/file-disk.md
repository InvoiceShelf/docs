---
versions: ['2']
reviewed_against: 0287adf6472dd4fe0f6f731c966afcd685086bdb
reviewed_hash: 6f543564981f7699b61918f68bb8eaaf917fe91a9a9c8cf907fb175ba47ec0e0
anchor_aliases:
  file-disk: configure-a-disk
  local-private: system-disks
  local-public: system-disks
---

# File storage

A file disk describes where InvoiceShelf stores uploaded or generated files. The database records the file references; copying only the database does not preserve the files themselves.

## Configure a disk

Open **Settings → File Disk** with storage-management permission. Add a disk using the supported driver and its required connection details. Check the driver’s endpoint, bucket or path and access credentials before saving.

![InvoiceShelf 2 file disk configuration](/images/v2/file-disk.webp)

## Choose what uses the disk

The page provides a **Default Disk** choice and **Save PDFs to Disk** setting. Review these together; do not follow v3 instructions for three separate media/PDF/backup assignments on v2.

## System disks

**Local Private** keeps files in application-managed private storage; **Local Public** serves files intended to be reachable publicly. Do not place database backups on public storage. Remote disks require credentials with only the access needed for that location.

Changing a default selects where subsequent operations write. It is not a bulk migration of files already stored elsewhere. Keep the original disk available while validating existing receipts, logos and PDFs.

## Verify storage

Upload a test receipt, open a customer document and create a [backup](./backups.md). Check that each file can be retrieved after the application restarts. Persist local storage volumes on Docker installations; data in a disposable container layer disappears when the container is replaced.

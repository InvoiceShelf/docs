---
versions: ['3']
reviewed_against: c4f6f8af2163fcc3a0c97d2046fcf22c1d47d0e7
reviewed_hash: d374cdda9499873eed10538e0232deffe86a2558c03d8265377180b9c9cc0d68
anchor_aliases:
  file-disk: configure-a-disk
  local-private: system-disks
  local-public: system-disks
---

# File storage

A file disk describes where InvoiceShelf stores uploaded or generated files. The database records the file references; copying only the database does not preserve the files themselves.

## Configure a disk

Open **Administration → Settings → File Disks** with storage-management permission. Add a disk using the supported driver and its required connection details. Check the driver’s endpoint, bucket or path and access credentials before saving.

![InvoiceShelf 3 file disk configuration](/images/v3/file-disk.webp)

## Choose what uses the disk

The **Disk Assignments** section separates **Media**, **PDF** and **Backup** storage. Select a suitable disk for each purpose and save. Keep backup storage separate from publicly accessible media.

## System disks

**Local Private** keeps files in application-managed private storage; **Local Public** serves files intended to be reachable publicly. Do not place database backups on public storage. Remote disks require credentials with only the access needed for that location.

Changing a default selects where subsequent operations write. It is not a bulk migration of files already stored elsewhere. Keep the original disk available while validating existing receipts, logos and PDFs.

## Verify storage

Upload a test receipt, open a customer document and create a [backup](./backups.md). Check that each file can be retrieved after the application restarts. Persist local storage volumes on Docker installations; data in a disposable container layer disappears when the container is replaced.

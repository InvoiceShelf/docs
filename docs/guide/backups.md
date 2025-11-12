# Backups

You can now take backup of your files & database directly from the UI.

Create a new backup from Settings -> Backups page or download previous backups.

![Backups](/images/backups.png)

## Create a New Backup

### Fields

- **Backup Type**: Specify the type of backup you want (full, only db, only files)
- **Disk**: The file disk in which you want to store the backup zip file.

## Restoring a Backup

### For Docker-based installation

> [!NOTE]
> Ensure InvoiceShelf is installed on your target system or server, preferably with the same `docker-compose` as the previous server, before restoring from a backup. For most users, restoring the database alone is sufficient (e.g., to restore data such as customers, invoices, payments, etc.).

#### Restoring Database (SQLite)

##### Step 1: Copy Dump
Extract the downloaded backup file to find the `SQL` file inside the `db_dumps` folder. Copy it to the server.

```
scp sqlite-sqlite-database.sql user@server:/path
```

##### Step 2: Recreate Database from Dump

Make sure SQLite is installed on the server.

```
sqlite3 database.sqlite < sqlite-sqlite-database.sql
```

#### Step 3: Copy the Database to Docker Container

```
docker cp /path/database.sqlite invoiceshelf:/var/www/html/storage/app/database.sqlite
```

#### Step 4: Restart the container

```
docker compose restart
```



---
title: Installation
lang: en-US
---

# Installation

- [Manual Installation](#manual-installation)
- [Docker Installation](#docker-installation)
- [Digital Ocean (Docker)](#digital-ocean-docker)

## Manual Installation

### Requirements

```
PHP >= 8.2.0
BCMath PHP Extension
Ctype PHP Extension
cURL PHP Extension
DOM PHP Extension
Filter PHP Extension
Iconv PHP Extension
JSON PHP Extension
Mbstring PHP Extension
OpenSSL PHP Extension
PDO PHP Extension
Session PHP Extension
Tokenizer PHP Extension
XML PHP Extension
ZIP PHP Extension
```

### Step 1 : Download

[Download](http://invoiceshelf.com/) the latest InvoiceShelf package.

Alternatively, If you are a developer, follow the instructions to setup development environment on [this Link](./developer-guide.md)

### Step 2 : Upload to Server

Upload the downloaded zip file to your Server and unzip it, you should see the InvoiceShelf folder.

### Step 3 : Point the domain to the uploaded folder

Point your domain or subdomain to the `public` directory inside the InvoiceShelf folder.

Please note that, InvoiceShelf must be installed on a primary domain or subdomain. Installing on a sub-folder will not work, for example:

- `example.com/invoiceshelf` (Invalid)
- `localhost/invoiceshelf` (Invalid)
- `example.com` (Valid)
- `invoiceshelf.example.com` (Valid)
- `invoiceshelf.test` (Valid)

### Step 3: Fix File Permissions

It is important to set the correct permissions for the storage and bootstrap/cache directories to ensure the application can write to these locations. Here are the steps:

1. Set Permissions: In your root directory, run the following commands to set the appropriate permissions:

```sh
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

2. Change Ownership (Optional): Additionally, you may need to change the ownership of these directories to the web server user (e.g., www-data for Apache/Nginx on Linux systems):

```sh
chown -R www-data:www-data storage
chown -R www-data:www-data bootstrap/cache
```

### Step 4 : Copy Environment File

1. Locate the Example File: In the root directory of your project, find the file named `.env.example`.
2. Copy the `.env.example` file and create a new file named `.env` in the same root directory.

```sh
cp .env.example .env
```

By following these steps, you will create a new `.env` file that can be customized with your environment-specific settings.

> For example, you can change the default SQLite database to MySQL or PostgreSQL.

### Step 5 : Complete installation wizard

Open the link to the domain in the browser (Example: `https://demo.invoiceshelf.com`) and complete the installation wizard as directed.

## Docker Installation

### Step 1 : Install Docker

Install Docker on your host: [https://docs.docker.com/install/](https://docs.docker.com/install/)

### Step 2 : Clone repository

Open terminal and clone the repository by running:

```
git clone https://github.com/InvoiceShelf/docker
```

### Step 3 : Initial docker compose setup

Navigate to the cloned repository folder (`docker`) and copy one of the example files (docker-compose.{db}.yml) to docker-compose.yml

If you want to use MySQL, take `docker-compose.mysql.yml` and copy it to `docker-compose.yml` in the same folder.

This will make it possible to run `docker compose up/down` commands without specifying `-f path/to/docker-compose.yml` in the `docker` folder.

### Step 4 : Finalize docker compose configuration

Edit `docker-compose.yml` and adjust the configuration as per your needs.

And finally, open Terminal in the `docker` folder and spin up InvoiceShelf app:

```
$ docker compose up -d
```

### Step 5 : Complete installation wizard

Open your web browser and go to your given domain and follow the installation wizard.

##### MySQL/PostgresSQL

For MySQL or PostgreSQL, you can use the following Database setup:

- Database Host: `invoiceshelf`
- Database Name: `invoiceshelf`
- Database Username: `invoiceshelf`
- Database Password: `somepass` (exactly, as define MYSQL_PASSWORD in docker-compose.yml)

##### SQLite

For SQLite, please leave the database.sqlite path as is and proceed.
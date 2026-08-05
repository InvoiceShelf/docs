---
title: Manual Installation
lang: en-US
---

# Manual Installation

Since InvoiceShelf is based on Laravel 13, the manual installation is similar to a Laravel
deployment. If you get stuck, consult the official [Laravel 13 deployment guide](https://laravel.com/docs/13.x/deployment#nginx).

## Requirements

```
PHP >= 8.4
BCMath PHP Extension
Ctype PHP Extension
cURL PHP Extension
DOM PHP Extension
Exif PHP Extension
Fileinfo PHP Extension
Filter PHP Extension
GD PHP Extension
Iconv PHP Extension
Intl PHP Extension
JSON PHP Extension
Mbstring PHP Extension
OpenSSL PHP Extension
PDO PHP Extension
Session PHP Extension
Tokenizer PHP Extension
XML PHP Extension
ZIP PHP Extension
```

## Step 1 : Download

[Download](https://invoiceshelf.com/download) the latest InvoiceShelf package.

Alternatively, If you are a developer, follow the instructions to setup development environment on [this Link](../developer-guide.md)

## Step 2 : Upload to Server

Upload the downloaded zip file to your Server and unzip it, you should see the InvoiceShelf folder.

## Step 3 : Point the domain to the uploaded folder

Point your domain or subdomain to the `public` directory inside the InvoiceShelf folder.

Please note that, InvoiceShelf must be installed on a primary domain or subdomain. Installing on a sub-folder will not work, for example:

- `example.com/invoiceshelf` (Invalid)
- `localhost/invoiceshelf` (Invalid)
- `example.com` (Valid)
- `invoiceshelf.example.com` (Valid)
- `invoiceshelf.test` (Valid)

## Step 4: Fix File Permissions

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

## Step 5 : Copy Environment File

1. Locate the Example File: In the root directory of your project, find the file named `.env.example`.
2. Copy the `.env.example` file and create a new file named `.env` in the same root directory.

```sh
cp .env.example .env
```
3. Make sure you set APP_KEY. You can generate one using:

```sh
php artisan key:generate
```

or generate it manually on the [following link](https://generate-random.org/laravel-key-generator).


By following these steps, you will create a new `.env` file that can be customized with your environment-specific settings.

> For example, you can change the default SQLite database to MySQL or PostgreSQL.

## Step 6 : Complete installation wizard

Open the link to the domain in the browser (Example: `https://demo.invoiceshelf.com`) and complete the installation wizard as directed.

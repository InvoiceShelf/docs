---
title: Setting Up with Laravel Herd
lang: en-US
---

# Setting Up with Laravel Herd

Laravel Herd is a great way to set up a local development environment on Windows/macOS.

## Step 1 : Install Laravel Herd

Follow the instructions on the [Laravel Herd website](https://herd.laravel.com) to install Herd on your system.

## Step 2 : Clone the Repository

If you forked the project, you can use the fork url instead.

```bash
git clone https://github.com/InvoiceShelf/InvoiceShelf.git 
cd InvoiceShelf
```

If you are using Linux/macOS, you need to setup the correct permissions:
```bash
chmod 775 storage/framework storage/logs bootstrap/cache
```

## Step 3 : Set Up Environment Variables

Copy the `.env.example` file to `.env` and configure your database and other settings:

```bash
cp .env.example .env
```

## Step 4 : Install Dependencies

Install PHP dependencies, NPM dependencies and build the project.

```bash
composer install
npm install
npm run dev
```

## Step 5 : Generate Application Key

```bash
php artisan key:generate
```

## Step 6 : Migrate the Database

```bash
php artisan migrate
```

## Step 7 : Start Laravel Herd

Make sure you are in the `~/Herd/InvoiceShelf` directory and run:
 
```bash
herd open
```

This will start development environment on [https://invoiceshelf.test](https://invoiceshelf.test)

With the free Herd version, you can use `sqlite` as database connection.

## Step 8 : Access the Application

Once Herd is running, you can access the InvoiceShelf application in your browser at `http://invoiceshelf.test`.

&nbsp;

---

This guide should help you get started with InvoiceShelf development. If you have any questions or run into issues, feel free to open an issue on [GitHub](https://github.com/InvoiceShelf/InvoiceShelf/issues).

Happy coding! 🧑‍💻
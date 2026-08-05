---
title: Setting Up with NGINX/PHP-FPM
lang: en-US
---

# Setting Up with NGINX/PHP-FPM

Setting up InvoiceShelf with NGINX and PHP-FPM is ideal for Linux systems. Follow the
[Laravel 13 NGINX deployment guide](https://laravel.com/docs/13.x/deployment#nginx) for the
web-server configuration.

## Step 1 : Install Dependencies

Depending on the Linux system those can be installed in different ways. 
   
For Debian/Ubuntu based distribution, you can do something like this:

```bash
# Install MariaDB
sudo apt install mariadb-server mariadb-client

# Install NGINX
sudo apt install nginx

# Install required tools
sudo apt install git curl zip unzip sqlite3

# Install PHP 8.4/PHP-FPM and the extensions InvoiceShelf uses
sudo apt install php8.4-fpm php8.4-gd php8.4-exif php8.4-mbstring php8.4-zip php8.4-curl php8.4-bcmath php8.4-xml php8.4-intl

# Install Node.js 24 and enable pnpm through Corepack
curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.39.5/install.sh | bash
nvm install 24
nvm use 24
corepack enable
```

## Step 2 : Clone the Repository

If you forked the project, you can use the fork url instead.

```bash
git clone --branch 3.x https://github.com/InvoiceShelf/InvoiceShelf.git
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

```bash
composer install
pnpm install
# For a one-time production build:
pnpm build
# If you want dev builds run:
pnpm dev
```

## Step 5 : Generate Application Key

```bash
php artisan key:generate
```

## Step 6 : Migrate the Database

```bash
php artisan migrate
```

## Step 7 : Configure NGINX

Follow the [Laravel 13 NGINX deployment guide](https://laravel.com/docs/13.x/deployment#nginx)
to create the NGINX server block configuration. Point the document root at the project's
`public` directory.

Finally, you need to restart NGINX.

## Step 8 : Access the Application

Once the server is running, you can access the InvoiceShelf application in your browser with the domain you configured in the NGINX config.

&nbsp;

---

This guide should help you get started with InvoiceShelf development. If you have any questions or run into issues, feel free to open an issue on [GitHub](https://github.com/InvoiceShelf/InvoiceShelf/issues).

Happy coding! 🧑‍💻

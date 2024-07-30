---
title: Setting Up with NGINX/PHP-FPM
lang: en-US
---

# Setting Up with NGINX/PHP-FPM

Setting up InvoiceShelf with NGINX and PHP-FPM is ideal for Linux systems. Follow the Laravel deployment guide for NGINX to set up your environment.

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

# Install PHP/PHP-FPM
sudo apt install php8.3-fpm php8.3-gd php8.3-exif php8.3-mbstring php8.3-zip php8.3-curl php8.3-bcmath

# Install NPM
curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.39.5/install.sh | bash
nvm install 20
nvm use 20
```

## Step 2 : Clone the Repository

```bash
git clone https://github.com/InvoiceShelf/InvoiceShelf.git
cd InvoiceShelf
```

## Step 3 : Set Up Environment Variables

Copy the `.env.example` file to `.env` and configure your database and other settings:

```bash
cp .env.example .env
```

## Step 4 : Install Dependencies

```bash
composer install
npm install
# If you want one-time build run:
npm run prod
# If you want dev builds run:
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

## Step 7 : Configure NGINX

Follow the Laravel guide to create NGINX server block configuration at [Laravel NGINX Deployment Guide](https://laravel.com/docs/11.x/deployment#nginx)

Finally, you need to restart NGINX.

## Step 8 : Access the Application

Once the server is running, you can access the InvoiceShelf application in your browser with the domain you configured in the NGINX config.

&nbsp;

---

This guide should help you get started with InvoiceShelf development. If you have any questions or run into issues, feel free to open an issue on [GitHub](https://github.com/InvoiceShelf/InvoiceShelf/issues).

Happy coding! 🧑‍💻
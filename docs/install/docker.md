---
title: Docker Installation
lang: en-US
---

# Docker Installation

We have pre-configured [Docker image](https://hub.docker.com/r/invoiceshelf/invoiceshelf) that can be run on your computer or cloud server.

Follow the steps bellow to get started.

If you notice any issues report it to [InvoiceShelf/docker](https://github.com/InvoiceShelf/docker/issues).

## Step 1 : Install Docker

Install Docker on your host: [https://docs.docker.com/install/](https://docs.docker.com/install/)

## Step 2 : Clone repository

Open terminal and clone the repository by running:

```sh
git clone https://github.com/InvoiceShelf/docker
```

## Step 3 : Prepare docker-compose

Navigate to the cloned repository folder `cd docker/` and copy one of the example docker compose files with your desired database to `docker-compose.yml`, like shown below:

### MySQL

```sh
cp ./docker-compose.mysql.yml docker-compose.yml
```

### PostgreSQL

```sh
cp ./docker-compose.pgsql.yml docker-compose.yml
```

### SQLite

```sh
cp ./docker-compose.sqlite.yml docker-compose.yml
```

> 📝 NOTE
>
> This will make it possible to run `docker compose` `up` or `down` commands without specifying `-f` ( or `--file` - compose configuration files) flag.

## Step 4 : Adjust the services environment variables

Open the newly created `docker-compose.yml` in your editor of choice and adjust the configuration as per your needs.

> ⚠️ IMPORTANT
>
> Make sure to pay close attention to the following environment variables when editing the file as after initial setup if you ever restart the container those will be used instead of what you entered during the setup.

> 📝 NOTE
>
> You can simply run the `docker compose -f docker-compose.XXX.yml up -d` (where XXX is the Database type of your choice) if you only want to trial the invoiceShelf without committing to a more permanent setup.
>
> You can ever remove `-d` (detached mode) so it only runs while you have the terminal open, though you will still need to manually clean-up the containers and images once you are done.

```yml
## truncated generic example `docker-compose.yml`

services:
  invoiceshelf_db:
    ...
    environment:
      ## Set your database password
      - XXX_PASSWORD=somepass # Where XXX is the Database Type of your choice.
    ...

  invoiceshelf:
    ...
    environment:
      ## Set to exactly the same password as in invoiceshelf_db service
      - DB_PASSWORD=somepass

      ## Set to your actual time zone - this is needed for running daily tasks
      ##  such as recurring invoices
      PHP timezone e.g. PHP_TZ=America/New_York

      ## Set to 'false' if running in production
      - APP_DEBUG=true

      ## If you are running in production and have a domain make sure to set an
      ##  actual domain name otherwise you will get CSRF error on login.
      ## Also make sure to update these values if you ever change the domain name.
      - APP_URL=http://localhost:90            # Set to https if using SSL.
      - SESSION_DOMAIN=localhost               # Enter just the domain name.
      - SANCTUM_STATEFUL_DOMAINS=localhost:90  # Enter the domain name and a custom port.

      ## Uncomment and set your smtp or other provider (ensure to use the same
      ##  as during the setup)
      - MAIL_DRIVER=smtp
      - MAIL_HOST=smtp.mailtrap.io
      - MAIL_PORT=2525
      - MAIL_USERNAME=null
      - MAIL_PASSWORD=null
      - MAIL_PASSWORD_FILE=<filename>
      - MAIL_ENCRYPTION=null
    ...
```

## Step 5 : Deploy the docker containers

Open the terminal in the `docker/` folder and spin up InvoiceShelf app:

```sh
docker compose up -d
```

> 📝 NOTE
>
> You can later run `docker compose down` to shutdown the application.

## Step 6 : Complete installation wizard

Open your web browser and go to your the url defined in your `APP_URL`, and follow the installation wizard.

### 6.1. Database Setup inside the Wizard

> 📝 NOTE
>
> In the future this section will not be necessary as we will implement a docker install detection system.

> ⚠️ IMPORTANT
>
> If using SQLite DB **leave the `database.sqlite` path as is**, otherwise it will NOT work correctly.

For MySQL and PostgreSQL, you can use the following Database setup:

| Field             | Value                                                                                 |
| ----------------- | ------------------------------------------------------------------------------------- |
| Database Host     | `invoiceshelf_db`                                                                     |
| Database Name     | `invoiceshelf`                                                                        |
| Database Username | `invoiceshelf`                                                                        |
| Database Password | `somepass` (or the password you defined in `DB_PASSWORD` inside `docker-compose.yml`) |

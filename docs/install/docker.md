---
title: Docker Installation
lang: en-US
---

# Docker Installation

We have pre-configured [Docker image](https://hub.docker.com/r/invoiceshelf/invoiceshelf) that can be run on your computer or cloud server.

Follow the steps bellow to get started.

If you notice any issues report it to [InvoiceShelf/docker](https://github.com/invoiceshelf/docker).

## Step 1 : Install Docker

Install Docker on your host: [https://docs.docker.com/install/](https://docs.docker.com/install/)

## Step 2 : Clone repository

Open terminal and clone the repository by running:

```
git clone https://github.com/InvoiceShelf/docker
```

## Step 3 : Prepare docker-compose

Navigate to the cloned repository folder (`docker`) and copy one of the example files (docker-compose.{db}.yml) to docker-compose.yml

If you want to use MySQL, take `docker-compose.mysql.yml` and copy it to `docker-compose.yml` in the same folder.

This will make it possible to run `docker compose up/down` commands without specifying `-f path/to/docker-compose.yml` in the `docker` folder.

## Step 4 : Finalize & Run docker-compose

Edit `docker-compose.yml` and adjust the configuration as per your needs.

And finally, open Terminal in the `docker` folder and spin up InvoiceShelf app:

```
$ docker compose up -d
```

## Step 5 : Complete installation wizard

Open your web browser and go to your given domain and follow the installation wizard.

##### 5.1. MySQL/PostgresSQL

For MySQL or PostgreSQL, you can use the following Database setup:

- Database Host: `invoiceshelf`
- Database Name: `invoiceshelf`
- Database Username: `invoiceshelf`
- Database Password: `somepass`

**Important**: The database password `somepass` is example and should be changed in the docker-compose.yml file before you run the project, especially if you expose it in public.

##### 5.2. SQLite Database

Leave the `database.sqlite` path as is, otherwise it will NOT work correctly.
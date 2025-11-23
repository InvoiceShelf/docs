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


### 3.1 Reverse Proxy Requirements
For spinning up the Docker Compose stack using reverse proxies and your own domain, the following environment variables are **required**: <br/>

 ####  APP_URL
 The full public URL (including protocol and port) where your application is accessed. Used for generating absolute URLs and redirects <br/>
- **Format**: `https://<subdomain-if-any>.<domain>.<tld>`
- **Examples**: 
    - `APP_URL=http://192.168.1.200`
    - `APP_URL=http://192.168.1.200:8080`
    - `APP_URL=http://199.199.1.199` # not recommended, run behind reverse proxy with SSL
    - `APP_URL=http://invoiceshelf.acme.com` # not recommended, try adding SSL
    - `APP_URL=https://invoiceshelf.acme.com`
    - `APP_URL=https://invoiceshelf.acme.com:8080`

#### SESSION_DOMAIN  
 The domain used for session cookies. Include port if using non-standard ports <br/>
- **With leading dot (.)**: Allows cookies across all subdomains (e.g., `.acme.com`)
- **Without dot**: Restricts cookies to specific domain only (e.g., `invoiceshelf.acme.com`)
- **Format**: `.<yourdomain>.<tld>` (note the leading dot for subdomain support)
- **Examples**:
  - `SESSION_DOMAIN=.acme.com` (with dot for subdomain support)
  - `SESSION_DOMAIN=invoiceshelf.acme.com` (without dot for specific domain)

#### SANCTUM_STATEFUL_DOMAINS
This is comma-separated list of domains allowed to manage stateful sessions. Typically includes your frontend domain(s) and ports <br/>
- **Format**: Comma-separated list of domains
- **Examples**:
  - `SANCTUM_STATEFUL_DOMAINS=invoiceshelf.acme.com`
  - `SANCTUM_STATEFUL_DOMAINS=invoiceshelf.acme.com,invoiceshelf.acme.com:8080`
  - `SANCTUM_STATEFUL_DOMAINS=localhost,localhost:3000,invoiceshelf.acme.com`

**Important**: Restart the container each time after modifying these variables in `docker-compose.yaml`.


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

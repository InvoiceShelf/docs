---
title: Docker Installation
lang: en-US
---

# Docker Installation

InvoiceShelf publishes production images at
[Docker Hub](https://hub.docker.com/r/invoiceshelf/invoiceshelf). The supported Compose
examples live in [InvoiceShelf/docker](https://github.com/InvoiceShelf/docker), which is
separate from the application's development Docker environment.

Follow the steps below to get started.

If you notice an issue with these production images or examples, report it to
[InvoiceShelf/docker](https://github.com/InvoiceShelf/docker).

## Step 1 : Install Docker

Install Docker on your host: [https://docs.docker.com/install/](https://docs.docker.com/install/)

## Step 2 : Clone repository

Open terminal and clone the repository by running:

```
git clone https://github.com/InvoiceShelf/docker.git
cd docker
```

## Step 3 : Prepare docker-compose

Choose a database variant and copy it to `docker-compose.yml`:

```bash
# SQLite (smallest setup; no separate database service)
cp docker-compose.sqlite.yml docker-compose.yml

# or MariaDB
cp docker-compose.mysql.yml docker-compose.yml

# or PostgreSQL
cp docker-compose.pgsql.yml docker-compose.yml
```

The repository's default `docker-compose.yml` points to the SQLite variant, but copying
the selected file makes the configuration explicit and lets you use normal `docker compose`
commands without `-f`.


### 3.1 Configure your public address

Before starting the stack, edit `docker-compose.yml`. Set these values to the address that
your browser uses to reach InvoiceShelf. Include a non-standard port in `APP_URL` and
`SANCTUM_STATEFUL_DOMAINS`; `SESSION_DOMAIN` is the hostname only.

 ####  APP_URL
 The full public URL (including protocol and port) where your application is accessed. It is used for absolute URLs and redirects.
- **Format**: `https://<subdomain-if-any>.<domain>.<tld>`
- **Examples**: 
    - `APP_URL=http://192.168.1.200`
    - `APP_URL=http://192.168.1.200:8080`
    - `APP_URL=http://199.199.1.199`
    - `APP_URL=http://invoiceshelf.acme.com`
    - `APP_URL=https://invoiceshelf.acme.com`
    - `APP_URL=https://invoiceshelf.acme.com:8080`

#### SESSION_DOMAIN  
 The domain used for session cookies. Do not include a protocol or port.
- **With leading dot (.)**: Allows cookies across all subdomains (e.g., `.acme.com`)
- **Without dot**: Restricts cookies to specific domain only (e.g., `invoiceshelf.acme.com`)
- **Format**: `.<yourdomain>.<tld>` (note the leading dot for subdomain support)
- **Examples**:
  - `SESSION_DOMAIN=.acme.com` (with dot for subdomain support)
  - `SESSION_DOMAIN=invoiceshelf.acme.com` (without dot for specific domain)

#### SANCTUM_STATEFUL_DOMAINS
This is a comma-separated list of domains allowed to manage stateful sessions. It normally
contains the same public host as `APP_URL`, including its port when one is used.
- **Format**: Comma-separated list of domains
- **Examples**:
  - `SANCTUM_STATEFUL_DOMAINS=invoiceshelf.acme.com`
  - `SANCTUM_STATEFUL_DOMAINS=invoiceshelf.acme.com,invoiceshelf.acme.com:8080`
  - `SANCTUM_STATEFUL_DOMAINS=localhost,localhost:3000,invoiceshelf.acme.com`

#### TRUSTED_PROXIES
Which upstream proxies may rewrite the client address, host, port and scheme. The default
`*` trusts every hop, which is what you want for a container behind a reverse proxy you
control.

If you narrow it, list the address **the container actually sees**, which is normally the
Docker bridge gateway (`172.x.x.x`) and not your proxy's LAN address. Getting this wrong
makes InvoiceShelf discard the proxy's `X-Forwarded-Proto` header and fall back to
generating `http://` links behind an https site, which shows up as a failed sign-in that
works after a page refresh.
- **Examples**:
  - `TRUSTED_PROXIES=*` (default)
  - `TRUSTED_PROXIES=172.18.0.1`

For example, a reverse-proxied installation at `https://invoices.example.com` uses:

```yaml
- APP_URL=https://invoices.example.com
- SESSION_DOMAIN=invoices.example.com
- SANCTUM_STATEFUL_DOMAINS=invoices.example.com
- TRUSTED_PROXIES=*
```

Restart the stack after changing these variables.


## Step 4 : Finalize & Run docker-compose

Edit `docker-compose.yml` and replace the example database credentials before exposing the
stack publicly. You may also pin the image tag instead of relying on `latest`.

And finally, open Terminal in the `docker` folder and spin up InvoiceShelf app:

```
docker compose up -d
```

## Step 5 : Complete installation wizard

Open the public address configured in `APP_URL` (for the supplied examples,
`http://localhost:8090`) and complete the installation wizard.

##### 5.1. MariaDB/PostgreSQL

For the MariaDB or PostgreSQL Compose variants, use the values you set in
`docker-compose.yml`. The database host is the Compose service name, `database`:

- Database Host: `database`
- Database Name: `invoiceshelf`
- Database Username: `invoiceshelf`
- Database Password: `somepass`

`somepass` is only an example. Change it, the database name, and username in both relevant
services in `docker-compose.yml` before making the installation public.

##### 5.2. SQLite Database

Select SQLite and leave the database path unchanged:
`/var/www/html/storage/app/database.sqlite`.

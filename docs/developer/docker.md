---
title: Setting Up with Docker
lang: en-US
---

# Setting Up with Docker

Using Docker is one of the easiest ways to set up InvoiceShelf for development. The
repository provides a `./devenv` wrapper that selects the supported Compose configuration,
adds the local hostname when needed, and starts the stack. The Compose files live in
`docker/development/`; `.dev` is no longer used.

## Step 1 : Clone the Repository

If you forked the project, you can use the fork url instead.

```bash
git clone --branch 2.x https://github.com/InvoiceShelf/InvoiceShelf.git
cd InvoiceShelf
cp .env.example .env
```

## Step 2 : Start the development environment

Run the wrapper with no arguments. It verifies Docker, adds `invoiceshelf.test` to the
hosts file when necessary (requesting sudo on Linux/macOS), then asks you to choose MySQL,
PostgreSQL, or SQLite and whether to enable Gotenberg.

```bash
./devenv
```

Your selected Compose file is saved in `.devenvconfig`. Later sessions can use:

```bash
./devenv start
./devenv stop
./devenv logs
./devenv shell
./devenv run php artisan migrate
./devenv test
./devenv format
```

## Step 3 : Install application dependencies

Install PHP dependencies and generate an application key inside the running PHP container:

```bash
./devenv run composer install
./devenv run php artisan key:generate
```

The frontend runs on the host. Install Node.js 24, enable Corepack, install the locked
dependencies, and keep the Vite development server running while you work:

```bash
corepack enable
pnpm install --frozen-lockfile
pnpm dev
```

## Step 4 : Access the Application

Once the containers are up and running, you can access the InvoiceShelf application in your browser at [http://invoiceshelf.test](http://invoiceshelf.test).


## Useful details

### a.) Working with Composer, pnpm, and tests

Use `./devenv run` to run a command in the PHP container, or use `./devenv shell` for an
interactive shell:

```bash
./devenv run php artisan migrate
./devenv test
./devenv format
```

### b.) Previewing the database

To see the database we use a tool called Adminer.

You can open it at `http://localhost:8080`.


### c.) Previewing Mail

To see the mail we use a tool called Mailpit. 

You can open it at `http://localhost:8025`.

---

&nbsp;

For implementation details, refer to
[docker/development](https://github.com/InvoiceShelf/InvoiceShelf/tree/2.x/docker/development).

&nbsp;

---

This guide should help you get started with InvoiceShelf development.

If you have any questions or run into issues, feel free to open an issue on [GitHub](https://github.com/InvoiceShelf/InvoiceShelf/issues). 

Happy coding! 🧑‍💻

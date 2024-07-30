---
title: Setting Up with Docker
lang: en-US
---

# Setting Up with Docker

Using Docker is one of the easiest ways to set up InvoiceShelf for development. The necessary Docker configuration files are located in the `.dev` folder of the repository.

## Step 1 : Clone the Repository

```bash
# If you forked the project, you can use the fork url.
git clone https://github.com/InvoiceShelf/InvoiceShelf.git
cd InvoiceShelf
```

## Step 2 : Set up DNS host

The dockerized development environment uses `invoiceshelf.test` local domain.

This domain needs to be set up on your machine to access the default configuration.

### a.) Linux/MacOS

If you are using Linux or macOS, edit `/etc/hosts` as root/sudo.

### b.) Windows

If you are using Windows, run Notepad as administrator and File > Open the `hosts` file in `C:Windows\System32\drivers\etc`

### Finalize

Add the following line at the end of the hosts file to make the invoiceshelf.test available:

```
127.0.0.1   invoiceshelf.test
```

## Step 3 : Spin up Docker

To spin up the Docker environment, run:

```bash
docker compose -f .dev/docker-compose.mysql.yml up --build
```

Once the environment is up and running you have the following containers:

- invoiceshelf-dev-php
- invoiceshelf-dev-mysql (or pgsql for sqlite)
- invoiceshelf-dev-nginx

## Step 4 : Access the Application

Once the containers are up and running, you can access the InvoiceShelf application in your browser at [http://invoiceshelf.test](http://invoiceshelf.test).

---

For more details, refer to the [Docker setup README](https://github.com/InvoiceShelf/InvoiceShelf/blob/master/.dev/README.md).

---

This guide should help you get started with InvoiceShelf development.

If you have any questions or run into issues, feel free to open an issue on [GitHub](https://github.com/InvoiceShelf/InvoiceShelf/issues). 

Happy coding! 🧑‍💻
# Recurring Invoices

As the name suggests, Recurring Invoices are for automatically creating invoices on a given schedule & limit. If you have a client or customer whom you're regularly billing the same invoice regularly then you can use this feature to automatically create and send the invoices.

#### Fields:

A Recurring Invoice is just like a wrapper to create invoices automatically. Thus most of the fields you see here are same as [Invoices](./invoices.md#add-new-invoice)

Some other additional fields are:

- **Limit**: By default, its set to "None" where it'll create unlimited invoices until you change the status to COMPLETED or ON_HOLD. Otherwise you can limit the creation by a given count or a date.
- **Frequency**: By default, its set to Weekly, but you can change to monthly, yearly or provide a custom cron format.

## Recurring Invoice Lifecycle

Below are the different statuses of a recurring invoice:

- **ACTIVE:** Actively creating invoices according to given schedule and limit.
- **ON HOLD:** To pause creating invoices.
- **COMPLETED:** To mark the Recurring Invoice as completed and stop creating invoices.

![Recurring Invoice Create Page](/images/recurring-invoices.png)

## Custom Frequency (Schedule):

InvoiceShelf supports creating recurring invoices based on a custom cron format. When you select Custom Format on _Frequency_ field, you can specify the expression yourself.

A CRON expression is a string representing the schedule for a particular command to execute. The parts of a CRON schedule are as follows:

```
*    *    *    *    *
-    -    -    -    -
|    |    |    |    |
|    |    |    |    |
|    |    |    |    +----- day of week (0 - 7) (Sunday=0 or 7)
|    |    |    +---------- month (1 - 12)
|    |    +--------------- day of month (1 - 31)
|    +-------------------- hour (0 - 23)
+------------------------- min (0 - 59)

```

## Server Configuration:

In order for InvoiceShelf to automatically create Invoices on a given schedule, you will need to configure your server to run the job every minute.

#### For Docker:

The InvoiceShelf image runs the scheduler itself, as a supervised service
alongside the web server, so a container install needs no cron of its own.

If your recurring invoices have never been created, update to a current image:
earlier images shipped no scheduler at all, and nothing on this page ran.

Set `SCHEDULER_ENABLED=false` only if you drive the schedule from somewhere
else, such as a second container running
`php artisan schedule:work` or more than one replica of the web container.
Leave it unset otherwise.

#### Other Providers:

You need to add a single cron configuration entry to the server that runs the schedule:run command every minute.

```
* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1
```

Example command for a shared hosting provider like Godaddy:

```
 /usr/local/bin/php /home/myuser/public_html/InvoiceShelf/artisan schedule:run >> /dev/null 2>&1
```

#### Hosts With No Cron At All:

Some shared hosts allow neither a crontab entry nor a long-running process. For
those, InvoiceShelf can be driven over HTTP: set a secret in your `.env`

```
CRON_JOB_AUTH_TOKEN=a-long-random-string
```

and have any external scheduler call the endpoint below once a minute, sending
the secret in the `x-authorization-token` header.

```
curl -H "x-authorization-token: a-long-random-string" https://your-invoiceshelf/api/cron
```

The endpoint refuses every caller while the token is unset, so it is inert
unless you deliberately turn it on. Calling it more often than once a minute is
harmless: extra calls answer `{"success": true, "ran": false}` and do nothing.

#### Testing Locally:

Run the below command if you would like to test recurring invoices on your local machine. (Note: This command does not work on windows)

```
php artisan schedule:work
```

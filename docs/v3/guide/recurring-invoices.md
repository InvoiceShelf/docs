---
versions: ['3']
reviewed_against: c4f6f8af2163fcc3a0c97d2046fcf22c1d47d0e7
reviewed_hash: 5d10cfaf60fcd2b74b3dc53f0ad3e47f92d60e1b0a51da0f0fdf49f9c870f08d
anchor_aliases:
  fields: create-a-schedule
  custom-frequency-schedule: custom-frequency
  for-docker: server-configuration
  other-providers: server-configuration
  testing-locally: server-configuration
---

# Recurring invoices

Recurring invoices store a schedule and the document details to use each time it runs. The server scheduler must be running for invoices to be generated.

## Create a schedule

Open **Invoices**, choose **New Invoice**, and turn on **Make Recurring**. The invoice list’s **One-time / Recurring** selector switches between issued invoices and schedules.

Choose the customer, start date and frequency, then add the items, prices, taxes and notes as you would for an ordinary invoice. Review the schedule and save. A recurring template is distinct from each invoice it later generates.

![InvoiceShelf 3 recurring invoice list](/images/v3/recurring.webp)

## Recurring invoice lifecycle

Use **All**, **Active** and **On Hold** to inspect schedules. An active schedule can generate invoices; putting it on hold stops future runs while preserving the existing documents. Check the issued invoice list after the expected run time.

Version 3 uses a recurring-invoice command that finds due schedules and can catch up after downtime. Check the generated periods after an interruption rather than manually creating duplicates.

## Custom frequency

A custom frequency uses five-field cron syntax: minute, hour, day of month, month and day of week. For example, `0 9 1 * *` means 09:00 on the first day of each month. Check **Settings → Preferences → Time Zone** before interpreting the schedule.

## Server configuration

On a manual installation, run Laravel’s scheduler once per minute as the application user, replacing the example path:

```cron
* * * * * cd /var/www/invoiceshelf && php artisan schedule:run >> /dev/null 2>&1
```

For local development, `php artisan schedule:work` runs it in the foreground. The official production Docker image has its own scheduler; avoid adding a second scheduler for the same installation. Use the container logs or server logs to investigate failures.

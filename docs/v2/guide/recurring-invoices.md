---
versions: ['2']
reviewed_against: 0287adf6472dd4fe0f6f731c966afcd685086bdb
reviewed_hash: 4c366d6bcc1f81621ea6ab06ff61d6a181f4d8d200dda1e6d48b868431c040f5
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

Open **Recurring Invoices** in the sidebar and select **New Recurring Invoice**.

Choose the customer, start date and frequency, then add the items, prices, taxes and notes as you would for an ordinary invoice. Review the schedule and save. A recurring template is distinct from each invoice it later generates.

![InvoiceShelf 2 recurring invoice list](/images/v2/recurring.webp)

## Recurring invoice lifecycle

Use **All**, **Active** and **On Hold** to inspect schedules. An active schedule can generate invoices; putting it on hold stops future runs while preserving the existing documents. Check the issued invoice list after the expected run time.

Version 2 registers each active schedule with its cron expression and company time zone. Keep the scheduler running at the scheduled minute; do not assume missed runs are automatically recovered.

## Custom frequency

A custom frequency uses five-field cron syntax: minute, hour, day of month, month and day of week. For example, `0 9 1 * *` means 09:00 on the first day of each month. Check **Settings → Preferences → Time Zone** before interpreting the schedule.

## Server configuration

On a manual installation, run Laravel’s scheduler once per minute as the application user, replacing the example path:

```cron
* * * * * cd /var/www/invoiceshelf && php artisan schedule:run >> /dev/null 2>&1
```

For local development, `php artisan schedule:work` runs it in the foreground. The official production Docker image has its own scheduler; avoid adding a second scheduler for the same installation. Use the container logs or server logs to investigate failures.

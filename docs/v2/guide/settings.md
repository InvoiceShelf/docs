---
versions: ['2']
reviewed_against: 0287adf6472dd4fe0f6f731c966afcd685086bdb
reviewed_hash: 664067f77f6c7be407c4bebba5c1560ffd92e87aa7a5de4f861f72f9f22e4b8f
anchor_aliases:
  settings: account-settings
  tax-types: other-company-settings
  expense-categories: other-company-settings
---

# Company and account settings

In v2, **Settings** contains account, company and server configuration entries. Your permissions determine which entries you can use.

## Company information

Select the company, open **Settings → Company Information**, and maintain its name, address, contact details and logo. Preview a document after a change to check how the information prints.

![InvoiceShelf 2 company information](/images/v2/company.webp)

## Preferences

Set the **Default Language**, **Time Zone**, **Date Format**, **Financial Year** and **Time Format**. The company currency is chosen when creating the company and cannot be changed here later. Review public-link expiry and the per-item discount setting on the same page.

![InvoiceShelf 2 company preferences](/images/v2/preferences.webp)

## Account settings

Open **Settings → Account Settings** to edit your name, email, profile photo and password. Save your changes before leaving the form.

![InvoiceShelf 2 account settings](/images/v2/account.webp)

## Notifications

Under **Notifications**, set the recipient address and choose whether invoice-viewed and estimate-viewed events should send email. Delivery depends on working [mail configuration](./mail.md).

![InvoiceShelf 2 notification preferences](/images/v2/notifications.webp)

## Other company settings

Maintain [tax types](./taxes.md), payment modes, [expense categories](./expenses.md), record notes and [custom fields](./custom-fields.md) in their corresponding entries. [Document customization](./customization.md) controls number formats and default text.

## Server configuration

The Settings menu also contains PDF Generation, Mail Configuration, File Disk, Backup and Update App. These affect installation services; make changes using an account authorized to manage them.

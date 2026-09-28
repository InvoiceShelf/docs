---
versions: ['3']
reviewed_against: c4f6f8af2163fcc3a0c97d2046fcf22c1d47d0e7
reviewed_hash: 6e98c24b8e4d112540701fd7880c626024638d8f515ae776ae9e63612ef39205
anchor_aliases:
  settings: account-settings
  tax-types: other-company-settings
  expense-categories: other-company-settings
---

# Company and account settings

Version 3 separates company settings, personal settings and global server administration. Choose the right scope before changing a value.

## Company information

Select the company, open **Settings → Company Information**, and maintain its name, address, contact details and logo. Preview a document after a change to check how the information prints.

![InvoiceShelf 3 company information](/images/v3/company.webp)

## Preferences

Set the **Default Language**, **Time Zone**, **Date Format**, **Financial Year** and **Time Format**. The company currency is chosen when creating the company and cannot be changed here later. Review public-link expiry and the per-item discount setting on the same page.

![InvoiceShelf 3 company preferences](/images/v3/preferences.webp)

## Account settings

Open your account menu and choose **User Settings**. General, Profile Photo, Security, Devices and Connected apps belong to your login rather than one company. See [Account security](./account-security.md).



## Notifications

Under **Notifications**, set the recipient address and choose whether invoice-viewed and estimate-viewed events should send email. Delivery depends on working [mail configuration](./mail.md).

![InvoiceShelf 3 notification preferences](/images/v3/notifications.webp)

## Other company settings

Maintain [tax types](./taxes.md), payment modes, [expense categories](./expenses.md), record notes and [custom fields](./custom-fields.md) in their corresponding entries. [Document customization](./customization.md) controls number formats and default text.

## Server administration

Use the company switcher to enter **Administration**. Its **Settings** cover global mail, PDFs, backups, storage, fonts, currencies, role presets, updates, appearance and AI connections. Company owners do not automatically receive global administrator access.

![InvoiceShelf 3 global settings](/images/v3/admin-settings.webp)

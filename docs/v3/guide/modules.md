---
versions: ['3']
reviewed_against: c4f6f8af2163fcc3a0c97d2046fcf22c1d47d0e7
reviewed_hash: d72256251aa028f63c168ed41341fe1c538dbe5034a26ba939c34e45e53cdf01
---

# Modules

Modules extend InvoiceShelf. A module must support the major version you run; an available listing does not make a v3-only package compatible with v2.

## Connect the marketplace

A super administrator opens **Administration → Modules** and selects **Pair marketplace**. Follow the displayed approval flow using the intended website account. The instance keeps its device credential on the server.

![InvoiceShelf 3 marketplace connection interface](/images/v3/admin-modules.webp)

## Install and configure

Read the module’s compatibility information, description and release notes. Back up the installation before installing or updating a module. Only use packages from a source you trust: a module adds code to your server.

Installation and activation are administrator tasks. Within a company, **Settings → Module Configuration** lists settings for modules the administrator has activated. An empty state there means no active module is available to configure; it is not the marketplace.

![InvoiceShelf 3 company module settings](/images/v3/modules.webp)

If access changes on the website, reconnect or refresh the installation as the interface instructs. Do not share marketplace tokens or approval codes in screenshots or support messages.

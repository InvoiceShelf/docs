---
versions: ['2']
reviewed_against: 0287adf6472dd4fe0f6f731c966afcd685086bdb
reviewed_hash: 831976e4dc06682f79eefdcfacc514be24fc4d6ffe684aec7997bf83b93c1f3f
anchor_aliases:
  email: email-configuration
---

# Email configuration

InvoiceShelf sends documents and notifications through a configured mail transport. Configure the sender and send a test message before emailing customers.

## Configure delivery

Open **Settings → Mail Configuration** with an account allowed to manage email configuration. In v2 these are installation-wide settings, even though the screen sits in the Settings menu.

![InvoiceShelf 2 mail configuration form](/images/v2/mail.webp)

Choose the mail driver and enter the provider’s settings. For SMTP, check **Mail Host**, **Mail Port**, **Mail Username**, **Mail Password**, encryption, **From Mail Address** and **From Mail Name**. Save and use **Test Mail Configuration** where shown. Confirm receipt and check the provider’s logs if delivery fails.

## Sendmail

Sendmail requires a working mail transport on the server; selecting it does not install or configure one. On a managed installation the hosting provider may control the default transport. Use provider-supplied SMTP details when no local mail service exists.

## Private networks

The v2 mail configuration does not implement the v3 `MAIL_ALLOWED_PRIVATE_HOSTS` setting. Restrict access to this server-level screen and ensure the configured host is reachable from the application runtime.

## Troubleshooting

An SMTP login error points to the credentials or provider’s authentication policy. A timeout points to DNS, host, port, firewall or transport settings. A successful provider submission does not guarantee inbox delivery: check spam placement and the sender domain’s provider-required DNS records. Never paste mail passwords into support screenshots.

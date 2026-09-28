---
versions: ['3']
reviewed_against: c4f6f8af2163fcc3a0c97d2046fcf22c1d47d0e7
reviewed_hash: 56afb485169d3e2ab42d62757fecb2fb0a55ea22c7e748b423112c8d0a40ab41
anchor_aliases:
  email: email-configuration
---

# Email configuration

InvoiceShelf sends documents and notifications through a configured mail transport. Configure the sender and send a test message before emailing customers.

## Configure delivery

A super administrator sets the default under **Administration → Settings → Mail Configuration**. A company can inherit it or open **Settings → Mail Configuration** and enable **Use Custom Mail Configuration** to override it for that company.

![InvoiceShelf 3 company mail inheritance setting](/images/v3/mail.webp)

Choose the mail driver and enter the provider’s settings. For SMTP, check **Mail Host**, **Mail Port**, **Mail Username**, **Mail Password**, encryption, **From Mail Address** and **From Mail Name**. Save and use **Test Mail Configuration** where shown. Confirm receipt and check the provider’s logs if delivery fails.

## Sendmail

Sendmail requires a working mail transport on the server; selecting it does not install or configure one. On a managed installation the hosting provider may control the default transport. Use provider-supplied SMTP details when no local mail service exists.

## Private networks

Self-hosted administrators can explicitly allow a private SMTP relay for company configuration through `MAIL_ALLOWED_PRIVATE_HOSTS`. See [Private networks](./private-networks.md). Managed Cloud custom SMTP is restricted to public hosts, secure transport and ports 465, 587 or 2525; it cannot reuse arbitrary internal services.

## Troubleshooting

An SMTP login error points to the credentials or provider’s authentication policy. A timeout points to DNS, host, port, firewall or transport settings. A successful provider submission does not guarantee inbox delivery: check spam placement and the sender domain’s provider-required DNS records. Never paste mail passwords into support screenshots.

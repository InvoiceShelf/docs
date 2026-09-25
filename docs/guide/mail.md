# Email

InvoiceShelf sends invoices, estimates, payment receipts and customer statements by email. It uses one of these transports: SMTP, sendmail, PHP's `mail`, Amazon SES, Mailgun or Postmark.

There are two levels of mail settings:

- **Server mail**, under **Administration → Settings → Mail Configuration**. Only the super admin can change it, and every company uses it by default.
- **Company mail**, under **Settings → Mail Configuration** in a company. A company owner can switch on a custom configuration, and that company then sends through its own transport and sender address.

## Sendmail

The sendmail command comes from the server, never from a settings screen. Set it with `MAIL_SENDMAIL_PATH` (default `/usr/sbin/sendmail -bs -i`); the mail settings only choose sendmail as the transport.

## Private networks

A company's mail settings could otherwise be used to make the server connect to internal services. So company owners, other than the super admin, may only use publicly reachable hosts:

- the SMTP host, and the host inside an SMTP URL, must not be a private, loopback, link-local or other reserved address;
- the Mailgun endpoint must be `api.mailgun.net` or `api.eu.mailgun.net`.

Saving a private host shows:

> The mail host must be a publicly reachable host, not a private or reserved address.

The super admin is not held to this. A relay on the local network, such as a Postfix container or an on-premises Exchange server, is an ordinary setup for the person who runs the server.

If company owners need a relay on your network and you accept that risk, name it in the environment, comma separated:

```bash
MAIL_ALLOWED_PRIVATE_HOSTS=mail.lan,192.168.1.10
```

Only those hosts become usable by company owners; every other private address is still refused. How entries are matched, and the equivalent setting for Gotenberg, are on the [Private Networks](./private-networks.md) page.

A private host saved by a company owner before this rule existed is refused when they send a test mail. Save a public host, or name the relay as above.

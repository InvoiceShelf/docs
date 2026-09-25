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

If company owners need a relay on your network and you accept that risk, name it in the environment:

```bash
MAIL_ALLOWED_PRIVATE_HOSTS=mail.lan,192.168.1.10
```

::: warning It names hosts, not an on/off switch
Only the hosts you list, comma separated, become usable by company owners. Every other private address is still refused. The setting is environment-only, so the person who controls the network decides which hosts are trusted, not anyone who can reach a settings page. `GOTENBERG_ALLOWED_PRIVATE_HOST` works the same way for the [PDF renderer](./pdf-generation.md#private-networks-and-the-ssrf-guard).
:::

The value is matched against the host alone, ignoring capitalisation. List the name or address exactly as it is entered in the mail settings; a name and the address it resolves to are different entries.

A private host saved by a company owner before this rule existed is refused when they send a test mail. Save a public host, or name the relay as above.

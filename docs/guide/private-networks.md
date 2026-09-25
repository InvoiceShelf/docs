# Private Networks

Some settings name a host that the server connects to: the Gotenberg PDF renderer, a company's mail server, an exchange-rate provider, an S3-compatible storage endpoint. InvoiceShelf refuses private, loopback, link-local and other reserved addresses in those settings. Otherwise anyone who can reach the settings screen could aim the server at services that are only meant to be reachable from inside your network, such as a database admin panel or a cloud provider's metadata endpoint.

When a setting is refused, the message says the host "must be a publicly reachable" address.

## Naming a trusted host

Some features legitimately talk to a host on your own network: Gotenberg usually runs as a sidecar container, and some installs relay mail through an internal server. For those, the operator names the trusted host in the environment, per feature:

| Variable | Feature | What it names | Example |
|---|---|---|---|
| `GOTENBERG_ALLOWED_PRIVATE_HOST` | [PDF generation](./pdf-generation.md#private-networks-and-the-ssrf-guard) | Exactly one Gotenberg URL | `http://pdf:3000` |
| `MAIL_ALLOWED_PRIVATE_HOSTS` | [Email](./mail.md#private-networks), for company owners | Mail hosts, comma separated | `mail.lan,192.168.1.10` |

Restart the app after changing them.

::: warning Hosts, not an on/off switch
Only what you list is exempt, and only for that feature. Every other private address stays refused, and naming your mail relay does not let the PDF setting reach it. There is deliberately no setting that turns the check off, and none of this is editable from the admin screens: the person who controls the network decides which hosts are trusted, not anyone who can reach a settings page.
:::

## How entries are matched

- An entry with a scheme, such as `http://pdf:3000`, exempts exactly that URL. Capitalisation and a trailing slash are ignored; a different port, `https` instead of `http`, or a path is a different URL.
- An entry without a scheme, such as `mail.lan`, exempts that host wherever it appears, as a bare host or inside a URL like `smtp://user:secret@mail.lan:25`.
- A name and the address it resolves to are separate entries. List the value exactly as it is entered in the setting.

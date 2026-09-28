---
versions: ['2']
reviewed_against: 0287adf6472dd4fe0f6f731c966afcd685086bdb
reviewed_hash: fead9b3db12e05976efe215b1cb7aabd6553257313ac0df76dd37478d7309f54
anchor_aliases:
  private-networks: private-network-services
---

# Private network services

InvoiceShelf may need to reach an internal PDF renderer. Configure a narrow exception for the specific service; a hostname resolving inside your network is not automatically trusted.

## Naming a trusted host

For a Gotenberg sidecar:

```dotenv
GOTENBERG_HOST=http://pdf:3000
GOTENBERG_ALLOWED_PRIVATE_HOST=http://pdf:3000
```

The exception is for the PDF renderer only. Keep its scheme, host and port aligned with the actual service. A different hostname or port is a different destination.

This v2 release does not provide the v3 `MAIL_ALLOWED_PRIVATE_HOSTS` option. Mail configuration is an installation-level permission in v2; see [Email](./mail.md).

## How entries are matched

The Gotenberg exception identifies the one explicitly configured private renderer URL. It is not a general permission for other settings to access your internal network. A private address without the relevant exception is rejected by the protected feature.

After changing environment variables, run `php artisan config:clear` and restart long-running workers. Verify connectivity from the application’s container or server, not only from your browser. Keep internal services off the public Internet.

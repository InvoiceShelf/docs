---
versions: ['3']
reviewed_against: c4f6f8af2163fcc3a0c97d2046fcf22c1d47d0e7
reviewed_hash: 38f7a6acf0f965a9a53133ee28de537affb48d0c0514bc4c4b0e5ff8db21f969
anchor_aliases:
  private-networks: private-network-services
---

# Private network services

InvoiceShelf may need to reach an internal PDF renderer or mail relay. Configure a narrow exception for the specific service; a hostname resolving inside your network is not automatically trusted.

## Naming a trusted host

For a Gotenberg sidecar:

```dotenv
GOTENBERG_HOST=http://pdf:3000
GOTENBERG_ALLOWED_PRIVATE_HOST=http://pdf:3000
```

The exception is for the PDF renderer only. Keep its scheme, host and port aligned with the actual service. A different hostname or port is a different destination.

For company mail configuration on a self-hosted server, `MAIL_ALLOWED_PRIVATE_HOSTS=mail.lan,192.168.1.10` permits the explicitly named relays. Entries are comma-separated; no wildcard is accepted. This does not relax managed Cloud SMTP restrictions.

## How entries are matched

An entry containing a scheme identifies a specific URL; a bare mail entry identifies a host. Exceptions are scoped to the feature that uses them. A private address without the relevant exception is rejected by the protected feature.

After changing environment variables, run `php artisan config:clear` and restart long-running workers. Verify connectivity from the application’s container or server, not only from your browser. Keep internal services off the public Internet.

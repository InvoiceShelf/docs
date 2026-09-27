---
versions: ['2']
reviewed_against: 0287adf6472dd4fe0f6f731c966afcd685086bdb
reviewed_hash: e899e0f1cc3f5e5bf1015dceaee7ca5fe24d70024424fb1e24532915edd47952
anchor_aliases:
  private-networks-and-the-ssrf-guard: running-gotenberg
---

# PDF generation

InvoiceShelf renders invoices, estimates, payment receipts and reports on the server. A working browser page does not by itself prove that the PDF renderer is configured correctly.

## Choosing a driver

Open **Settings → PDF Generation**. **dompdf** renders in PHP and is the default. **Gotenberg** sends HTML to a separate Chromium-based rendering service; it must be installed and reachable before selecting it.

![InvoiceShelf 2 PDF generation settings](/images/v2/pdf.webp)

## Running Gotenberg

Run Gotenberg on a private service network reachable by the PHP runtime. For a sidecar named `pdf` listening on port 3000, the relevant application environment is:

```dotenv
PDF_DRIVER=gotenberg
GOTENBERG_HOST=http://pdf:3000
GOTENBERG_ALLOWED_PRIVATE_HOST=http://pdf:3000
```

The private-host exception must match the configured renderer address. Do not expose the renderer publicly just to make the application reach it. If the settings screen has stored an override, update it too. Clear cached Laravel configuration after environment changes with `php artisan config:clear`, then restart long-running workers.

## Configuration

Version 2’s settings screen selects the renderer. Its template and driver configuration differ from v3’s page-geometry and font-package controls. Test layout changes against this release rather than copying v3 PDF settings.

## Troubleshooting

First generate a short invoice using a built-in template. If it works, compare the failing template or data. For Gotenberg timeouts, check the service network and exact allowed URL. Missing characters point to font coverage; missing logos can indicate a file-storage path problem. Server logs contain the rendering exception.

For layout changes, use [custom templates](./custom-templates.md) instead of editing bundled designs in place.

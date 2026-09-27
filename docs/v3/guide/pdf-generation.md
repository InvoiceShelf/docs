---
versions: ['3']
reviewed_against: c4f6f8af2163fcc3a0c97d2046fcf22c1d47d0e7
reviewed_hash: 105b3db824fc96766a9e9ccc49be03b7c36394558ee442a57fec054236aa079a
anchor_aliases:
  private-networks-and-the-ssrf-guard: running-gotenberg
---

# PDF generation

InvoiceShelf renders invoices, estimates, payment receipts and reports on the server. A working browser page does not by itself prove that the PDF renderer is configured correctly.

## Choosing a driver

Open **Administration → Settings → PDF Generation**. **dompdf** renders in PHP and is the default. **Gotenberg** sends HTML to a separate Chromium-based rendering service; it must be installed and reachable before selecting it.

![InvoiceShelf 3 PDF generation settings](/images/v3/pdf.webp)

## Running Gotenberg

Run Gotenberg on a private service network reachable by the PHP runtime. For a sidecar named `pdf` listening on port 3000, the relevant application environment is:

```dotenv
PDF_DRIVER=gotenberg
GOTENBERG_HOST=http://pdf:3000
GOTENBERG_ALLOWED_PRIVATE_HOST=http://pdf:3000
```

The private-host exception must match the configured renderer address. Do not expose the renderer publicly just to make the application reach it. If the settings screen has stored an override, update it too. Clear cached Laravel configuration after environment changes with `php artisan config:clear`, then restart long-running workers.

## Configuration

Version 3 exposes page size, orientation and margins in the screen. Environment defaults use `PDF_PAPER_WIDTH=210mm`, `PDF_PAPER_HEIGHT=297mm`, `PDF_ORIENTATION=portrait` and `PDF_MARGIN_TOP/RIGHT/BOTTOM/LEFT=0`. Stock document templates provide their own insets. Reports use `PDF_REPORT_MARGIN` separately. Gotenberg page numbers need a nonzero bottom margin. See [Font packages](./fonts.md) for additional writing systems.

## Troubleshooting

First generate a short invoice using a built-in template. If it works, compare the failing template or data. For Gotenberg timeouts, check the service network and exact allowed URL. Missing characters point to font coverage; missing logos can indicate a file-storage path problem. Server logs contain the rendering exception.

For layout changes, use [custom templates](./custom-templates.md) instead of editing bundled designs in place.

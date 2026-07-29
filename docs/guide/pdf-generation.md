# PDF Generation

InvoiceShelf renders invoices, estimates and payment receipts to PDF using one of two drivers. **dompdf** is the default and needs nothing extra. **Gotenberg** renders through headless Chromium and produces noticeably better output, at the cost of running one more service.

The driver is an instance-wide setting, configured by a super admin under **Settings → PDF Generation**.

## Choosing a driver

| | dompdf | Gotenberg |
|---|---|---|
| Extra infrastructure | None | A Gotenberg service |
| CSS support | A conservative subset | Everything Chromium supports |
| Mixed-script documents | Falls back to boxes | Renders correctly |
| Setup effort | None | A container and two settings |

Stay on dompdf unless something below applies — it works out of the box and has no moving parts.

Reach for Gotenberg when:

- **Your documents mix writing systems.** dompdf uses the *first* font in the chain for every character rather than falling back per glyph. A company running an English locale with a customer whose name is in Hebrew, Arabic or Chinese will see empty boxes where that name should be. Gotenberg has no such limitation.
- **Your templates use modern CSS.** Flexbox, grid, and most layout features added in the last decade render in Chromium and not in dompdf. If you maintain [custom templates](/guide/custom-templates.md), this is usually the reason to switch.

## Running Gotenberg

Gotenberg ships as a container and needs no configuration of its own. Add it alongside InvoiceShelf:

```yaml
services:
  invoiceshelf:
    image: invoiceshelf/invoiceshelf:latest
    environment:
      - PDF_DRIVER=gotenberg
      - GOTENBERG_HOST=http://pdf:3000
      - GOTENBERG_ALLOWED_PRIVATE_HOST=http://pdf:3000
    networks:
      - invoiceshelf

  pdf:
    image: gotenberg/gotenberg:8
    networks:
      - invoiceshelf

networks:
  invoiceshelf:
```

The service does not need a published port. InvoiceShelf reaches it over the internal network, so leaving it unpublished keeps it off your host entirely — which is what you want, since Gotenberg has no authentication of its own.

If you develop against this repository, `./devenv` sets all of this up for you when you answer yes to *"Use Gotenberg for PDF generation?"*.

## Configuration

Every setting can come from the environment or from **Settings → PDF Generation**. The database value wins where both are present, so the environment acts as the default.

| Variable | Default | Purpose |
|---|---|---|
| `PDF_DRIVER` | `dompdf` | `dompdf` or `gotenberg` |
| `PDF_PAPER_WIDTH` | `210mm` | Page width |
| `PDF_PAPER_HEIGHT` | `297mm` | Page height |
| `PDF_ORIENTATION` | `portrait` | `portrait` or `landscape` |
| `PDF_MARGIN_TOP` | `1.2cm` | Top page margin |
| `PDF_MARGIN_RIGHT` | `1.2cm` | Right page margin |
| `PDF_MARGIN_BOTTOM` | `1.2cm` | Bottom page margin |
| `PDF_MARGIN_LEFT` | `1.2cm` | Left page margin |
| `PDF_PAGE_NUMBERS` | `false` | Repeat the page number on every page (Gotenberg only) |
| `GOTENBERG_HOST` | `http://pdf:3000` | Where the Gotenberg service listens |
| `GOTENBERG_PDFA` | *(unset)* | `PDF/A-1b`, `PDF/A-2b` or `PDF/A-3b` for archival output |
| `GOTENBERG_ALLOWED_PRIVATE_HOST` | *(unset)* | Exempts one private host from the SSRF guard — see below |

Sizes and margins are a number followed by `pt`, `px`, `pc`, `mm`, `cm` or `in`. The settings screen offers the usual paper sizes as presets, and a Custom option for anything else.

### Page setup applies to both drivers

Paper size, orientation and margins are honoured whichever driver renders the document, so switching between them does not change the layout. The `1.2cm` margin default is dompdf's own, which is why documents look the same after switching to Gotenberg.

### Archival output

Set `GOTENBERG_PDFA`, or pick a format under **Settings → PDF Generation**, to produce PDF/A. It is what you want for long-term archives, and PDF/A-3 is what the EU e-invoicing formats expect. Gotenberg only: dompdf cannot produce PDF/A.

### Page numbers

Turning page numbers on repeats `1 / 4` at the foot of every page. It needs a bottom margin to sit in, since the footer draws inside the page margin. A template supplying its own footer keeps it — see [custom templates](/guide/custom-templates.md). Gotenberg only.

## Private networks and the SSRF guard

Gotenberg almost always runs on a private network, and InvoiceShelf blocks private addresses by default. This is the one part of the setup that needs explaining.

When you save a Gotenberg host, InvoiceShelf refuses private, loopback, link-local and other reserved addresses:

> The gotenberg host must be a publicly reachable URL, not a private or reserved address.

That guard exists because InvoiceShelf sends the rendered document to whatever host you configure **and returns the response body to the browser as the PDF**. Without it, an attacker who reached the settings screen could point the host at an internal service — a database admin panel, or a cloud provider's metadata endpoint — and read the response back as a download.

Since `http://pdf:3000` resolves to a private address, that guard would block the standard setup. Declaring the host lifts it:

```bash
GOTENBERG_ALLOWED_PRIVATE_HOST=http://pdf:3000
```

::: warning It names a host, not an on/off switch
Only the exact value you set here is exempt. Pointing the Gotenberg host at any *other* private address is still refused, so the exemption cannot be reused to reach the rest of your network.

This is also why the setting is environment-only and absent from the admin UI: the person who decides a private host is trustworthy should be the person who controls the network, not anyone who can reach a settings page.
:::

The value must match what you enter as the Gotenberg host, though comparison ignores capitalisation and a trailing slash. If the two differ in any other way — a different port, `https` instead of `http`, a path — the exemption does not apply.

## Troubleshooting

**"The gotenberg host must be a publicly reachable URL, not a private or reserved address."**

Your Gotenberg host is on a private network and has not been declared. Set `GOTENBERG_ALLOWED_PRIVATE_HOST` to exactly the same URL and restart the container.

**The host saved without complaint, but generating a PDF fails.**

Hostnames that do not resolve are allowed through at save time — a name that points nowhere cannot reach a private network, so there is nothing to block. A typo therefore saves cleanly and only fails later, when the render is attempted. Check the spelling against your Gotenberg service name, and confirm both containers share a network:

```bash
docker compose exec invoiceshelf getent hosts pdf
```

**PDFs render, but text in some scripts is missing or shows as boxes.**

That is dompdf's font behaviour, and switching to Gotenberg is the fix — see [Choosing a driver](#choosing-a-driver) above.

**Documents time out on large invoices.**

Chromium needs more memory than dompdf. Give the Gotenberg container more headroom before assuming the document is at fault.

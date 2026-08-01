# Custom Templates

InvoiceShelf ships three invoice designs and three estimate designs. You can add your own, and they appear alongside the built-in ones in the **Choose a Template** dialog.

Custom templates live outside the application code, so they survive upgrades and Docker image rebuilds:

```bash
storage/app/templates/pdf/{invoice|estimate}/{template_name}.blade.php
```

::: warning Note the `app/` segment
Earlier versions of this page documented `storage/templates/pdf/`. That path does not work: a template placed there is never found. The correct location is `storage/app/templates/pdf/`.
:::

## Creating a template

### With `make:template`

```bash
php artisan make:template your-template-name
```

Under Docker:

```bash
docker compose exec invoiceshelf php artisan make:template your-template-name
```

The command clones the first built-in design of the type you choose, rewrites its includes to point at your copy, and writes a preview image. Edit the resulting file to taste.

Pass `--type` to skip the prompt:

```bash
php artisan make:template your-template-name --type=estimate
```

### By hand

Create a `.blade.php` file in the directory for its type:

- **Invoices**: `storage/app/templates/pdf/invoice/`
- **Estimates**: `storage/app/templates/pdf/estimate/`

Any `.blade.php` file in those directories is picked up automatically and offered in the **Choose a Template** dialog.

Add a `.png` alongside it with the same name to control the thumbnail shown there. Without one, the preview of the built-in design is used instead.

![Custom Templates](/images/custom-templates.png)

## What a template receives

Each template is rendered with the document's data already shared into the view. Invoices and estimates get `$invoice` (or `$estimate`), `$customFields`, `$company_address`, `$shipping_address`, `$billing_address`, `$notes`, `$logo` and `$taxes`.

The quickest way to iterate is the `?preview` query parameter on the document's PDF URL, which renders the template as plain HTML in the browser instead of a PDF:

```
/invoices/pdf/{hash}?preview=true
```

## The line-items table

The built-in designs pull their line-items table from a partial, and a cloned template gets its own copy:

```blade
@include('pdf_templates::invoice.partials.your-template-name.table')
```

It belongs to that template alone, so editing it does not affect your other designs.

## Repeating page headers and footers

A file named after your template with a `_header` or `_footer` suffix is repeated on every page:

```
storage/app/templates/pdf/invoice/branded.blade.php
storage/app/templates/pdf/invoice/branded_header.blade.php
storage/app/templates/pdf/invoice/branded_footer.blade.php
```

These companions do not appear in the template picker; they belong to the template they are named after.

::: warning Gotenberg only
Repeating page furniture is a Chromium capability, so it applies when the Gotenberg driver is selected. dompdf has no equivalent.
:::

They are drawn *inside* the page margin, so give the relevant margin room under **Settings → PDF Generation**, and style them inline — Chromium renders them in their own context and they inherit none of the document's CSS:

```html
<div style="font-size:9px;width:100%;padding:0 15mm;text-align:right;">
  Page <span class="pageNumber"></span> of <span class="totalPages"></span>
</div>
```

`pageNumber` and `totalPages` are substituted by the browser. If you only want page numbers, turn them on under **Settings → PDF Generation** instead of writing a footer.

## Overriding payment receipts and reports

Payment receipts and the five reports have no picker: there is one design, and a custom file replaces it outright. Name the file after the document you are replacing:

| Document | File |
|---|---|
| Payment receipt | `storage/app/templates/pdf/payment/payment.blade.php` |
| Expenses report | `storage/app/templates/pdf/reports/expenses.blade.php` |
| Profit & loss | `storage/app/templates/pdf/reports/profit-loss.blade.php` |
| Sales by customer | `storage/app/templates/pdf/reports/sales-customers.blade.php` |
| Sales by item | `storage/app/templates/pdf/reports/sales-items.blade.php` |
| Tax summary | `storage/app/templates/pdf/reports/tax-summary.blade.php` |

`make:template` clones these too:

```bash
php artisan make:template expenses --type=reports
php artisan make:template payment --type=payment
```

Payment receipts are rendered with `$payment`, `$company_address`, `$billing_address`, `$notes` and `$logo`. Reports get `$company`, `$from_date`, `$to_date`, `$currency` and their own dataset.

## Spacing and the page edge

The page margin defaults to nothing, so a template owns its own insets — the bundled ones use 30px. That is what lets a full-width header run to the paper edge: put it at the top of `<body>` with no margin on `body`, and it bleeds. Set a page margin under **Settings → PDF Generation** and everything, including that header, is inset by it.

## Fonts

Templates get their `@font-face` rules from the packages installed under **Settings → Font Packages**, via a shared partial:

```blade
@include("app.pdf.partials.fonts")
```

Keep that include unless you are supplying fonts yourself. Without it the document falls back to the driver's default font, which for documents mixing writing systems is usually not what you want.

## Choosing a design per document

The template is stored on each invoice and estimate, so different documents can use different designs. Ticking **Set as default** in the picker remembers your choice for the documents you create from then on.

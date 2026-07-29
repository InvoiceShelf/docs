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

Add a `.png` alongside it with the same name to give it a thumbnail there. Without one the tile renders blank, so it is worth adding even if you just copy the built-in preview.

![Custom Templates](/images/custom-templates.png)

## What a template receives

Each template is rendered with the document's data already shared into the view. Invoices and estimates get `$invoice` (or `$estimate`), `$customFields`, `$company_address`, `$shipping_address`, `$billing_address`, `$notes`, `$logo` and `$taxes`.

The quickest way to iterate is the `?preview` query parameter on the document's PDF URL, which renders the template as plain HTML in the browser instead of a PDF:

```
/invoices/pdf/{hash}?preview=true
```

## The shared line-items table

The built-in designs pull their line-items table from a partial, and a cloned template includes it too:

```blade
@include('pdf_templates::invoice.partials.table')
```

::: warning One table, shared by all your custom templates
That partial is written once, the first time you create a custom template of a type, and every later one of that type includes the *same* file. Editing
`storage/app/templates/pdf/invoice/partials/table.blade.php` changes the table for **all** your custom invoice templates, not just the one you are working on.

If you need different tables, point each template at its own copy: create a second file next to it and change that template's `@include` to match.
:::

## Fonts

Templates get their `@font-face` rules from the packages installed under **Settings → Font Packages**, via a shared partial:

```blade
@include("app.pdf.partials.fonts")
```

Keep that include unless you are supplying fonts yourself. Without it the document falls back to the driver's default font, which for documents mixing writing systems is usually not what you want.

## Choosing a design per document

The template is stored on each invoice and estimate, so different documents can use different designs. Ticking **Set as default** in the picker remembers your choice for the documents you create from then on.

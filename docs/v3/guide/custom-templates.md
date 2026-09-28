---
versions: ['3']
reviewed_against: c4f6f8af2163fcc3a0c97d2046fcf22c1d47d0e7
reviewed_hash: d3bf2603ea9ec7061ab6e846ff3a8600961e132943c79ef832c73ada05814082
anchor_aliases:
  custom-templates: custom-pdf-templates
  with-make-template: custom-pdf-templates
  by-hand: creating-a-template
  the-shared-line-items-table: line-items-and-partials
---

# Custom PDF templates

Use custom templates for layout changes beyond [document customization](./customization.md). This requires access to the application files and familiarity with Laravel Blade. Work on a copy and test the generated PDF before selecting a design for real documents.

## Creating a template

From the application directory:

```bash
php artisan make:template studio --type=invoice
php artisan make:template studio --type=estimate
```

The commands create separate invoice and estimate designs under `storage/app/templates/pdf/`, with a Blade file and preview image. Persist this storage directory across deployments and include it in backups.

Version 3 also supports exact-name overrides: `php artisan make:template payment --type=payment`, or report names `expenses`, `profit-loss`, `sales-customers`, `sales-items` and `tax-summary` with `--type=reports`. These replace a specific document and do not add a picker entry.

## What a template receives

Start from the generated file’s variables and includes. Keep the existing amount and tax formatting rather than recalculating totals in Blade. Use escaped output for user-entered values, and inspect long addresses, notes and multiple-page documents.

## Line items and partials

Version 3 copies the design’s partials into its own template-specific area and rewrites includes. Edit the generated references; a report can include a copied layout and styles, while Gotenberg designs can also have header/footer companions.

## Fonts

Use fonts available to the configured renderer. See [Font packages](./fonts.md) for v3’s managed PDF fonts. Browser font availability alone does not guarantee PDF coverage.

## Choosing a design per document

Create or edit an invoice or estimate and select its template. Preview the output and confirm line wrapping, totals, address blocks and page breaks. Keep the corresponding preview image aligned with the design so users can recognize it.

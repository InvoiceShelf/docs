---
versions: ['2']
reviewed_against: 0287adf6472dd4fe0f6f731c966afcd685086bdb
reviewed_hash: edf7ebc0676f3586b99e9e50daf5fe670051c649c36c824d517a35031e80b34b
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

The v2 command offers invoice and estimate designs. Do not use the v3 payment/report override commands on this release.

## What a template receives

Start from the generated file’s variables and includes. Keep the existing amount and tax formatting rather than recalculating totals in Blade. Use escaped output for user-entered values, and inspect long addresses, notes and multiple-page documents.

## Line items and partials

Version 2 copies a shared `partials/table.blade.php` for each document type. Editing that shared table can change every custom design of that type. Check all custom invoice or estimate designs after modifying it.

## Fonts

Use fonts available to the configured renderer. The v3 Font Packages screen is not part of v2. Verify the actual font embedded by your template and renderer. Browser font availability alone does not guarantee PDF coverage.

## Choosing a design per document

Create or edit an invoice or estimate and select its template. Preview the output and confirm line wrapping, totals, address blocks and page breaks. Keep the corresponding preview image aligned with the design so users can recognize it.

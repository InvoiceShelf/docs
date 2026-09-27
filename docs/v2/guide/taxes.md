---
versions: ['2']
reviewed_against: 0287adf6472dd4fe0f6f731c966afcd685086bdb
reviewed_hash: 83a285f2e5f71315abad3ae7c1891b59a4e965c50ec76d19a284d6e84cb79a66
anchor_aliases:
  tax-type-fields: what-is-a-tax-type
  what-is-a-compound-tax: compound-taxes
  example: compound-taxes
---

# Taxes

Maintain the tax choices under **Settings → Tax Types**. Tax rates and the way they apply depend on your business; InvoiceShelf calculates the selections you configure.

## What is a tax type

Select **Add New Tax** and enter the name and calculation details shown in the form. Give each rate a recognizable name. Save it, then select that tax on the relevant sales document. Review a sample invoice’s subtotal, tax and total after changing a rate or tax setting.

![InvoiceShelf 2 tax types and per-item/inclusive tax settings](/images/v2/taxes.webp)

## Tax per item vs tax on total invoice amount

**Tax Per Item** changes whether taxes are entered on individual lines or on the document total. Use per-item taxes when different items need different treatment. The invoice form reflects the company setting; inspect every line before sending.

**Inclusive taxes** means the entered price already includes the tax. With exclusive pricing, tax is added to the price. Changing this interpretation can change the total even when the visible rate stays the same.

## Compound taxes

A compound tax is calculated after other applicable taxes, so its base can include an earlier tax. It is not equivalent to simply adding two percentages. Use a small test document and compare the calculated amounts with your expected result before using compound taxes in customer invoices.

The v2 expense form differs from v3’s input-tax interface. Follow the [v2 expense guide](./expenses.md) for the fields present in this release.

Use [Reports → Taxes](./reports.md#taxes-report) to inspect recorded tax amounts for a selected period.

---
versions: ['3']
reviewed_against: c4f6f8af2163fcc3a0c97d2046fcf22c1d47d0e7
reviewed_hash: 3a3e7972436a3678b34f47c5a088231c1b83cc4c22bcade5444a74a5c8cdb151
anchor_aliases:
  tax-type-fields: what-is-a-tax-type
  what-is-a-compound-tax: compound-taxes
  example: compound-taxes
---

# Taxes

Maintain the tax choices under **Settings → Tax Types**. Tax rates and the way they apply depend on your business; InvoiceShelf calculates the selections you configure.

## What is a tax type

Select **Add New Tax** and enter the name and calculation details shown in the form. Give each rate a recognizable name. Save it, then select that tax on the relevant sales document. Review a sample invoice’s subtotal, tax and total after changing a rate or tax setting.

![InvoiceShelf 3 tax types and per-item/inclusive tax settings](/images/v3/taxes.webp)

## Tax per item vs tax on total invoice amount

**Tax Per Item** changes whether taxes are entered on individual lines or on the document total. Use per-item taxes when different items need different treatment. The invoice form reflects the company setting; inspect every line before sending.

**Inclusive taxes** means the entered price already includes the tax. With exclusive pricing, tax is added to the price. Changing this interpretation can change the total even when the visible rate stays the same.

## Compound taxes

A compound tax is calculated after other applicable taxes, so its base can include an earlier tax. It is not equivalent to simply adding two percentages. Use a small test document and compare the calculated amounts with your expected result before using compound taxes in customer invoices.

Version 3 also exposes taxes on the expense form, separating gross cost, input tax and net cost. See [Expenses](./expenses.md) for that workflow.

Use [Reports → Taxes](./reports.md#taxes-report) to inspect recorded tax amounts for a selected period.

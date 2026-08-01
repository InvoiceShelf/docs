# Credit Notes

A credit note reverses an invoice you have already sent. Once an invoice is out, its number is spent: correcting it by editing the original leaves a gap in your books, so accounting practice is to issue a second document that cancels the first (a *Stornorechnung*, in German bookkeeping). InvoiceShelf does exactly that.

A credit note is a document of its own, with its own number, and it carries every amount of the original invoice negated. The two documents therefore sum to zero, which is what makes the reversal complete and auditable.

## Creating one

Open the invoice and choose **Create Credit Note** from its action menu. InvoiceShelf copies the invoice, negates every amount, and saves the result as a new credit note in **Draft**.

There is nothing to fill in. A credit note always reverses its invoice in full, so it has no editable line items of its own.

## What can be credited

| Rule | Why |
|---|---|
| One credit note per invoice | A second reversal of the same invoice would double-count |
| An invoice cannot be credited twice, and a credit note cannot be credited | The reversal is already complete |
| Draft invoices cannot be credited | An invoice that was never issued has nothing to reverse. Edit or delete it instead |
| Invoices with recorded payments cannot be credited | Money has already changed hands. Record a refund or a correcting document instead |

Credit notes cannot be edited after they are created. If the wrong invoice was credited, delete the credit note and the original invoice returns to its previous state, balance included.

Deleting the invoice while its credit note still exists is blocked. Delete both together, or delete the credit note first.

## What it does to the original invoice

Creating the credit note settles the invoice. It drops out of the unpaid and awaiting-payment views, since nothing is owed on it any more, and its detail page shows a **Cancelled** badge that links through to the credit note. The credit note carries a matching banner linking back to the invoice it reverses.

## Sending it

A credit note starts as a draft and goes to the customer through the normal Send flow, the same one you use for invoices. Its email uses a credit-note template rather than the invoice one.

The PDF renders through whichever invoice template the company uses (`invoice1`, `invoice2`, `invoice3` or a custom design), so a credit note looks like the invoice it reverses. On top of that it carries a credit-note banner, a reference line naming the original invoice and its date, and negative amounts throughout.

::: tip Custom templates
A custom invoice template needs one include to display those banners. See [custom templates](/guide/custom-templates.md#credit-notes).
:::

## Numbering

Credit notes have their own sequence, independent of invoices. The default format is `CN-000001`, and creating a credit note never advances the invoice counter.

You can change the format under **Settings → Customization → Invoices**, where a **Credit Notes** number customizer sits beside the invoice one. It works the same way: prefix, series and sequence are yours to arrange.

## Dashboard and reports

Credit note totals are negative, so they subtract from your sales figures automatically. A reversed invoice and its credit note cancel out, and revenue for the period reflects that.

Invoice counts do not include credit notes, so the number of invoices you see is still the number of invoices you issued.

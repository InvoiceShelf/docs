# Credit Notes

A credit note reverses an invoice you have already sent. Once an invoice is out, its number is spent: correcting it by editing the original leaves a gap in your books, so accounting practice is to issue a second document that cancels the first (a *Stornorechnung*, in German bookkeeping). InvoiceShelf does exactly that.

A credit note is a document of its own, with its own number, and it carries negated amounts. Reverse the whole invoice and the two documents sum to zero, which is what makes the reversal complete and auditable. Reverse part of it and the credit note carries only the part you credited.

## Creating one

Open the invoice and choose **Create Credit Note** from its action menu. A form opens listing every line of the invoice: what was invoiced, how much of it has already been credited, how much is left, and an editable quantity to credit.

Everything still creditable is filled in for you, so accepting the form as it opens reverses the invoice in full. That is what most credits are, and it stays a two-click job.

To credit less, lower a quantity or clear a line's checkbox. Only the line subtotals are shown, because discounts and taxes are not yours to apportion: InvoiceShelf credits them in proportion to the lines and quantities you chose, so the credit note always agrees with the document it reverses, down to the cent.

A **Reason** can be given and is optional. It is stored on the credit note and printed on the document, which is where an auditor will look for it.

The result is saved as a new credit note in **Draft**.

## Crediting an invoice more than once

An invoice can carry several credit notes. Each one credits some of what is still left, and the quantities already credited by earlier notes are shown in the form so you always know where you stand. Crediting a line in instalments adds up to exactly what crediting it in one go would have produced.

Once every line has been credited in full there is nothing left to reverse, and the invoice will not accept another credit note.

## What can be credited

| Rule | Why |
|---|---|
| A line can be credited only down to the quantity that is left of it | Anything more would reverse goods that were never invoiced |
| A credit cannot exceed the amount still outstanding on the invoice | Payments have already settled part of it, and only the unpaid remainder can be reversed. A fully paid invoice cannot be credited at all; refund it instead |
| An invoice with nothing left to credit cannot be credited again | The reversal is already complete |
| A credit note cannot itself be credited | It is the reversal, not the thing being reversed |
| Draft invoices cannot be credited | An invoice that was never issued has nothing to reverse. Edit or delete it instead |
| A credited invoice can no longer be edited | Its line items anchor the lines of every credit note that reverses it, so changing them would falsify documents already issued |

Credit notes cannot be edited after they are created. If you credited the wrong thing, delete the credit note: the original invoice gets back exactly what that note took off it, balance included, and any other credit notes on the invoice stay as they are.

Deleting the invoice while a credit note still reverses it is blocked. Delete both together, or delete the credit note first.

## What it does to the original invoice

A credit note reduces the invoice's outstanding balance by the amount credited.

Credit part of the invoice and it stays open for the remainder. Its detail page shows a **Partially credited** badge with the amount credited so far, next to its real paid status: a credit is not a payment, and an invoice that was half credited and never paid is still unpaid, just for less.

Credit all of it and the invoice is settled. It drops out of the unpaid and awaiting-payment views, since nothing is owed on it any more, and shows a **Cancelled** badge instead.

Both badges link through to the credit notes involved, and each credit note carries a matching banner linking back to the invoice it reverses.

## Sending it

A credit note starts as a draft and goes to the customer through the normal Send flow, the same one you use for invoices. Its email uses a credit-note template rather than the invoice one.

The PDF renders through whichever invoice template the company uses (`invoice1`, `invoice2`, `invoice3` or a custom design), so a credit note looks like the invoice it reverses. On top of that it carries a credit-note banner, a reference line naming the original invoice and its date, the reason if you gave one, and negative amounts throughout.

The original invoice's PDF says what happened to it too. A partly credited invoice carries a **Partially Credited** banner naming the amount and the credit notes it came from; a fully credited one carries the **Cancelled** banner, listing every credit note that reversed it. Its totals block reports **Amount Credited** separately from **Amount Paid**, so a document settled by a credit note never claims money that was never received.

::: tip Custom templates
A custom invoice template needs one include to display those banners. See [custom templates](/guide/custom-templates.md#credit-notes).
:::

## Numbering

Credit notes have their own sequence, independent of invoices. The default format is `CN-000001`, and creating a credit note never advances the invoice counter.

You can change the format under **Settings → Customization → Invoices**, where a **Credit Notes** number customizer sits beside the invoice one. It works the same way: prefix, series and sequence are yours to arrange.

## Dashboard and reports

Credit note totals are negative, so they subtract from your sales figures automatically. A reversed invoice and its credit note cancel out, and revenue for the period reflects that.

Invoice counts do not include credit notes, so the number of invoices you see is still the number of invoices you issued.

---
versions: ['3']
reviewed_against: c4f6f8af2163fcc3a0c97d2046fcf22c1d47d0e7
reviewed_hash: f5c2ecda21358d86e03a1da9dbc658c365b1a7ff64b79ad8336c251b60c3d7cd
anchor_aliases:
  add-new-invoice: add-a-new-invoice
  invoice-fields: add-a-new-invoice
  list-invoices: find-and-inspect-invoices
  invoice-lifecycle: understand-the-status
  invoiceshelf-3-document-view: find-and-inspect-invoices
---

# Invoices

An invoice records what a customer owes. Use **Invoices** in the company sidebar to create, inspect and follow up on sales documents.

## Add a new invoice

1. Select **New Invoice** and choose the customer.
2. Check **Invoice Date**, **Due Date** and **Invoice Number**.
3. Select or enter the items, then check each quantity and price. Add a discount or tax where required by your configuration.
4. Add notes, choose the PDF template and check the total.
5. Select **Save Invoice**. Saving a draft is separate from sending it to the customer.

![InvoiceShelf 3 new invoice form](/images/v3/invoice-create.webp)

The **Make Recurring** switch changes this form into a recurring schedule. Keep it off for a one-time invoice. The drag handle on a line also supports keyboard reordering.

## Find and inspect invoices

Use the tabs and **Filter** controls to narrow the list. Select an invoice number to open its PDF preview and available actions. Check the customer, dates, currency, line amounts and notes in the rendered document before emailing it.

![InvoiceShelf 3 invoice list and status columns](/images/v3/invoices.webp)

![InvoiceShelf 3 invoice details with the actual generated PDF](/images/v3/invoice.webp)

## Understand the status

- **Draft**: saved but not yet sent.
- **Sent**: the invoice has been sent or marked sent.
- **Viewed**: the public document has been viewed.
- **Completed**: the invoice is fully paid.
- **Unpaid**, **Partially Paid** and **Paid** describe payment state. A due date and remaining balance determine whether an invoice is overdue.

Use the document’s action menu to send it or mark it sent when your role allows. **Mark as sent** records status; it does not deliver email. Confirm [mail settings](./mail.md) before sending.

## Record a payment

Use **Record Payment** on the invoice, or create a payment and allocate it to invoices from the payment form. See [Payments](./payments.md). A partial payment leaves the remaining balance due.

---
versions: ['2']
reviewed_against: 0287adf6472dd4fe0f6f731c966afcd685086bdb
reviewed_hash: 87f72f6707114a50cf5104f27e0e5721df9e327bbc4bdedc4f1acc9cf1ff1226
anchor_aliases:
  add-new-invoice: add-a-new-invoice
  invoice-fields: add-a-new-invoice
  list-invoices: find-and-inspect-invoices
  invoice-lifecycle: understand-the-status
  invoiceshelf-3-document-view: invoices
---

# Invoices

An invoice records what a customer owes. Use **Invoices** in the company sidebar to create, inspect and follow up on sales documents.

## Add a new invoice

1. Select **New Invoice** and choose the customer.
2. Check **Invoice Date**, **Due Date** and **Invoice Number**.
3. Select or enter the items, then check each quantity and price. Add a discount or tax where required by your configuration.
4. Add notes, choose the PDF template and check the total.
5. Select **Save Invoice**. Saving a draft is separate from sending it to the customer.

![InvoiceShelf 2 new invoice form](/images/v2/invoice-create.webp)

Recurring invoices have their own sidebar page and creation workflow; creating an ordinary invoice does not schedule future copies.

## Find and inspect invoices

Use the tabs and **Filter** controls to narrow the list. Select an invoice number to open its PDF preview and available actions. Check the customer, dates, currency, line amounts and notes in the rendered document before emailing it.

![InvoiceShelf 2 invoice list and status columns](/images/v2/invoices.webp)

![InvoiceShelf 2 invoice details with the actual generated PDF](/images/v2/invoice.webp)

## Understand the status

- **Draft**: saved but not yet sent.
- **Sent**: the invoice has been sent or marked sent.
- **Viewed**: the public document has been viewed.
- **Completed**: the invoice is fully paid.
- **Unpaid**, **Partially Paid** and **Paid** describe payment state. A due date and remaining balance determine whether an invoice is overdue.

Use the document’s action menu to send it or mark it sent when your role allows. **Mark as sent** records status; it does not deliver email. Confirm [mail settings](./mail.md) before sending.

## Record a payment

Create a payment from the invoice’s actions or from **Payments**, selecting this invoice. See [Payments](./payments.md). A partial payment leaves the remaining balance due.

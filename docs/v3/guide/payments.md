---
versions: ['3']
reviewed_against: c4f6f8af2163fcc3a0c97d2046fcf22c1d47d0e7
reviewed_hash: 1fc7c20b0d3dc2b7a1ab5f67e6337f81f5c17c7e94ae6ab754e1c2b9379d47c3
anchor_aliases:
  new-payment: create-a-payment
  payment-fields: create-a-payment
  list-payments: find-a-receipt
  add-new-payment: payments
---

# Payments

Record money received from a customer under **Payments**. Keep the customer, currency, date and amount consistent with the receipt you are recording.

## Create a payment

1. Select **Add Payment**.
2. Check **Date** and **Payment Number**, then select the **Customer**.
3. Enter the **Amount** and choose the **Payment Mode** if you track how the money arrived.
4. Use **Invoice Allocations** to distribute the amount. **Add Allocation** selects a document; **Allocate Oldest First** offers a starting allocation which you should review.
5. Add a note if needed and select **Save Payment**.

![InvoiceShelf 3 payment form with invoice allocations](/images/v3/payment-create.webp)

## Allocated amounts and credit

The form shows **Allocated** and **Unapplied Credit**. Check both before saving. An amount not allocated to an invoice remains customer credit; it should not be mistaken for settlement of every open invoice. Keep allocations within the payment’s amount and use the customer’s matching documents.

## Find a receipt

The list shows payment number, date, customer, payment mode and amount. Open a payment to view its receipt and the operations your role permits. Sending a receipt requires working [mail settings](./mail.md).

![InvoiceShelf 3 payment list](/images/v3/payments.webp)

Use [Reports](./reports.md) for date-range totals. Recording a receipt is different from creating an invoice, so sales and receipts need not match within the same reporting period.

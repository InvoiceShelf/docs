---
versions: ['2']
reviewed_against: 0287adf6472dd4fe0f6f731c966afcd685086bdb
reviewed_hash: 2656ef1d55d12ada2c8efe97ae0fed62b28af2c7ba04b70a810a4432ea4b1464
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
4. Select the **Invoice** to which this payment belongs. The v2 form links a payment to a single invoice.
5. Add a note if needed and select **Save Payment**.

![InvoiceShelf 2 payment form with an invoice selector](/images/v2/payment-create.webp)

## Invoice balance

A payment smaller than the invoice’s remaining balance leaves it partially paid. Open the invoice afterwards to check the balance. The v2 payment form does not have v3’s multiple-invoice allocation controls.

## Find a receipt

The list shows payment number, date, customer, payment mode and amount. Open a payment to view its receipt and the operations your role permits. Sending a receipt requires working [mail settings](./mail.md).

![InvoiceShelf 2 payment list](/images/v2/payments.webp)

Use [Reports](./reports.md) for date-range totals. Recording a receipt is different from creating an invoice, so sales and receipts need not match within the same reporting period.

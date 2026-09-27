---
versions: ['3']
reviewed_against: c4f6f8af2163fcc3a0c97d2046fcf22c1d47d0e7
reviewed_hash: 8592055ad039a3599d1f4115de61db2f5a5ba410f965756a5c5938a6ff37d573
anchor_aliases:
  add-new-estimate: create-an-estimate
  estimate-fields: create-an-estimate
  list-estimates: review-and-send
  invoice-fields: estimates
  estimate-lifecycle: estimates
---

# Estimates

Use an estimate to quote proposed work before it becomes an invoice. Open **Estimates** in the company sidebar.

## Create an estimate

1. Select **New Estimate** and choose a customer.
2. Check **Estimate Date**, **Expiry Date** and **Estimate Number**.
3. Add the items, quantities and prices. Review discounts, taxes and the total.
4. Add notes that explain the scope or conditions, choose a template and select **Save Estimate**.

![InvoiceShelf 3 estimate form](/images/v3/estimate-create.webp)

## Review and send

Open an estimate number from the list to inspect its preview. Use the action menu to email the quotation when [mail](./mail.md) is configured. A saved draft does not send itself.

![InvoiceShelf 3 estimate list](/images/v3/estimates.webp)

Estimates can be **Draft**, **Sent**, **Viewed**, **Accepted**, **Rejected** or **Expired**. An expiry date limits the quotation’s validity; the scheduler handles automatic expiry. Customers can review estimates through their [portal](./customer-portal.md).

## Turn accepted work into an invoice

Use **Convert to Invoice** from the estimate’s available actions. Review the resulting invoice’s dates, number, customer, lines and total before sending it. Conversion does not record a customer payment; that belongs to the [payment workflow](./payments.md).

---
versions: ['3']
reviewed_against: c4f6f8af2163fcc3a0c97d2046fcf22c1d47d0e7
reviewed_hash: 8c62817ff9842aacbbdb1392ea2e4ab2302239fb51d7444ceb205f718a21abf1
anchor_aliases:
  add-new-customer: add-a-customer
  customer-fields: add-a-customer
  list-customers: find-and-edit-customers
---

# Customers

Customers hold the contact information, currency and addresses used on sales documents. Select the correct company, then open **Customers** in the sidebar.

## Add a customer

1. Select **New Customer**.
2. Enter a **Display Name** and choose the **Primary Currency**. Add the primary contact, email, phone, website, prefix and tax ID where applicable.
3. Complete the billing address. Use **Copy from Billing** when the shipping address is the same; otherwise enter it separately.
4. Enable **Portal Access** only when you want this customer to sign in. See the [customer portal guide](./customer-portal.md).
5. Review any custom fields and select **Save Customer**.

![InvoiceShelf 3 customer form and billing address fields](/images/v3/customer-create.webp)

## Find and edit customers

The list shows contact details and the **Net Account Balance**. Use **Filter** to narrow the list, select a customer’s name to open their details, and use the row’s action menu for available operations. Customer records belong to the selected company.

![InvoiceShelf 3 customer list](/images/v3/customers.webp)

The account balance can include invoice balances and unapplied credit. Open the customer’s documents and payment allocations before treating it as the amount due on a particular invoice.

Changes to a contact record do not mean an invoice has been emailed. Sending a document is a separate action in the [invoice](./invoices.md) or [estimate](./estimates.md) workflow.

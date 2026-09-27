---
versions: ['2']
reviewed_against: 0287adf6472dd4fe0f6f731c966afcd685086bdb
reviewed_hash: dcccdf7f218191849f41a533cefdfed3a6c4f041e5d407d5becc39bc38aa89e0
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

![InvoiceShelf 2 customer form and billing address fields](/images/v2/customer-create.webp)

## Find and edit customers

The list shows contact details and the customer’s amount due. Use **Filter** to narrow the list, select a customer’s name to open their details, and use the row’s action menu for available operations. Customer records belong to the selected company.

![InvoiceShelf 2 customer list](/images/v2/customers.webp)

Open the customer’s invoices and payments to inspect the documents behind the displayed balance.

Changes to a contact record do not mean an invoice has been emailed. Sending a document is a separate action in the [invoice](./invoices.md) or [estimate](./estimates.md) workflow.

---
versions: ['3']
reviewed_against: c4f6f8af2163fcc3a0c97d2046fcf22c1d47d0e7
reviewed_hash: 658051b3db305bbfceff31736321edd12fe953e5ee90637abbc6555e6f421b24
---

# Customer portal

The customer portal lets a customer review their own invoices, estimates and payment receipts. It is separate from your staff account and company administration.

## Allowing customer access to the portal

Edit the [customer](./customers.md), enable **Portal Access**, and supply the login details requested by the form. Save the customer. Give the customer the company-specific portal address and their credentials through an appropriate private channel.

The portal address includes your company slug, for example `https://invoices.example.com/acme/customer/login`. Use your installation’s actual address and company slug; `/admin/login` is the staff sign-in page.

## Accessing the portal

Sign in as the customer. The dashboard shows **Amount Due**, counts of documents, due invoices and recent estimates. The customer sees documents belonging to their customer record, not all of the company’s accounts.

![InvoiceShelf 3 customer portal signed in as a demonstration customer](/images/v3/portal.webp)

## Viewing invoices

Open **Invoices** and select a document to inspect or download it. **Estimates** and **Payments** have their own navigation entries. A public document link in an email is a different access path from a portal login, and its expiry follows your company’s [preferences](./settings.md).

## Making payments

Payment receipts shown here are records of payments entered in InvoiceShelf. Do not assume a payment gateway is connected because the portal lists invoices; online checkout depends on the integrations available and configured on your installation.

## Managing profile

Use **Settings** in the portal for the customer account settings available to that login. To change the company’s billing contact record or disable portal access, a staff member edits the customer in the main application.

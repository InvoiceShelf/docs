# Customer Portal

The Customer Portal allows your customers to view their invoices, make payments, and manage their profiles. This guide will help you set up and navigate the Customer Portal.

## Accessing the Portal

Customers can access the portal by navigating to the provided URL, such as `https://your.url/{company:slug}/customer`. They will need to log in using the email and password provided during registration.

## Allowing Customer Access to the Portal

`admin/customers/{customer:id}/edit`

When editing a customer, you can enable their access to the portal by toggling the authorization access. Below this option, the portal URL will be displayed, and you will need to set a password. The customer can then access the portal using their email address and the defined password.

## Viewing Invoices

`{company:slug}/customer/invoices`

Once logged in, customers can view their invoices by clicking on the "Invoices" tab. Here, they can:

- View a list of all invoices.
- See the status of each invoice (paid, unpaid, overdue).
- Download invoices in PDF format.

## Making Payments

> Currently, InvoiceShelf does not support online payments.

## Managing Profile

Customers can update their profile information by clicking on the "Settings" tab. Here, they can:

- Update personal details (name, email, phone number).
- Change their password.

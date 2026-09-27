---
versions: ['2']
reviewed_against: 0287adf6472dd4fe0f6f731c966afcd685086bdb
reviewed_hash: 0bc142771697d954be4bc66e7d53e0ebfb5a3a462a09cfa58b649848d5593199
anchor_aliases:
  customization: invoices
  invoice-prefix: invoices
  default-invoice-email-body: default-text-and-addresses
  default-body: default-text-and-addresses
  company-address-format: default-text-and-addresses
  default-company-address-format: default-text-and-addresses
  shipping-address-format: default-text-and-addresses
  default-shipping-address-format: default-text-and-addresses
  billing-address-format: default-text-and-addresses
  default-billing-address-format: default-text-and-addresses
  autogenerate-invoice-number: invoices
  estimate-prefix: estimates
  default-estimate-email-body: default-text-and-addresses
  default-body-1: default-text-and-addresses
  company-address-format-1: default-text-and-addresses
  default-company-address-format-1: default-text-and-addresses
  shipping-address-format-1: default-text-and-addresses
  default-shipping-address-format-1: default-text-and-addresses
  billing-address-format-1: default-text-and-addresses
  default-billing-address-format-1: default-text-and-addresses
  autogenerate-estimate-number: estimates
  payment-prefix: payments
  default-payment-email-body: default-text-and-addresses
  default-body-2: default-text-and-addresses
  company-address-format-2: default-text-and-addresses
  default-company-address-format-2: default-text-and-addresses
  from-customer-address-format: default-text-and-addresses
  from-customer-address-format-1: default-text-and-addresses
  autogenerate-payment-number: payments
---

# Document customization

Open **Settings → Customization** to set defaults for invoices, estimates, payments and items. These settings fill new forms; always review an individual document before sending it.

## Invoices

The invoice tab contains **Invoice Number Format**. Add the components you need, such as a series, delimiter and sequence, and inspect **Preview Invoice Number** before saving. Arrange the components in the number-format editor. Changing a default does not renumber existing invoices.

![InvoiceShelf 2 invoice customization and number format](/images/v2/customization.webp)

Configure an automatic due-date offset if you want new invoices to start with a due date. **Retrospective Edits** controls when an invoice becomes protected from further changes. Select a rule that fits your document workflow.

## Default text and addresses

Edit **Default Invoice Email Body**, **Company Address Format**, **Shipping Address Format** and **Billing Address Format** using the supplied fields. Use **Insert Fields** for customer and company placeholders instead of typing values that should change per document.

Send a test document after editing email defaults. Preview the PDF after editing address formats, especially when a company name or street address is long. Blank source fields remain blank in the output.

## Estimates

Select the **Estimates** tab to configure estimate numbering and default text. Estimate defaults are independent of invoice defaults. Check an estimate preview instead of assuming an invoice change applies to both.

## Payments

Select **Payments** for receipt numbering and text. A payment receipt records money received; changing its format does not allocate or reverse a payment.

## Items

The **Items** tab contains item-related defaults. For structural PDF changes beyond these editors, see [Custom templates](./custom-templates.md).

---
versions: ['2']
reviewed_against: 0287adf6472dd4fe0f6f731c966afcd685086bdb
reviewed_hash: eee133d61b0c0d59b9d12cace4f671e90116aec7092d4daf908fac70c5295154
anchor_aliases:
  add-new-custom-field: add-a-custom-field
  custom-field-options: add-a-custom-field
  how-to-use-custom-fields: use-a-custom-field
---

# Custom fields

Custom fields collect information beyond the standard form, such as a customer account reference or contract renewal date. Open **Settings → Custom Fields**.

## Add a custom field

1. Select **Add Custom Field**.
2. Enter the **Name** and **Label**. The label is the text people see beside the input.
3. Select the **Model** that owns the field, such as Customer, Invoice, Estimate, Expense or Payment.
4. Choose its **Type**, then configure the options relevant to that type, such as a default value or dropdown choices.
5. Set **Required** only if every new record should supply a value, and save.

![InvoiceShelf 2 custom field editor](/images/v2/custom-field-create.webp)

The v2 editor includes placeholder and default-value controls. Its available types include text, textarea, phone, URL, number, dropdown, switch, date, date/time and time. It does not have the v3 editor’s expanded validation layout.

## Use a custom field

Open a create or edit form for the model you selected. Enter a value in its custom-fields section and save the record. If a field is missing, check the selected company and model first.

![InvoiceShelf 2 custom field list](/images/v2/custom-fields.webp)

For document text, use **Insert Fields** in supported note or [customization](./customization.md) editors. Preview the resulting PDF to confirm the chosen field is populated and positioned as intended. Changing a field definition does not automatically supply values for old records.

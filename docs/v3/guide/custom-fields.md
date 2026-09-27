---
versions: ['3']
reviewed_against: c4f6f8af2163fcc3a0c97d2046fcf22c1d47d0e7
reviewed_hash: 2f4d9c65ac2e25d7dd407008080a32e2ccb4e161ca6cde70b7958b5cdafbcde2
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

![InvoiceShelf 3 custom field editor](/images/v3/custom-field-create.webp)

The v3 editor also exposes **Show on document**, **Order** and an expandable **Validation** section. The field’s name builds the placeholder referenced by templates. Configure these deliberately; a field used internally need not be printed on a customer document.

## Use a custom field

Open a create or edit form for the model you selected. Enter a value in its custom-fields section and save the record. If a field is missing, check the selected company and model first.

![InvoiceShelf 3 custom field list](/images/v3/custom-fields.webp)

For document text, use **Insert Fields** in supported note or [customization](./customization.md) editors. Preview the resulting PDF to confirm the chosen field is populated and positioned as intended. Changing a field definition does not automatically supply values for old records.

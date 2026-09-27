---
versions: ['3']
reviewed_against: c4f6f8af2163fcc3a0c97d2046fcf22c1d47d0e7
reviewed_hash: 12e2dec8f0475ccc6877efe0a3ce7c570fd538c25c40f5b02968c26dd1f3c65f
anchor_aliases:
  add-new-expense: record-an-expense
  expense-fields: record-an-expense
  list-expenses: organize-and-find-expenses
---

# Expenses

Use **Expenses** to record business spending and attach receipts. Categories make related costs easier to find in reports.

## Record an expense

1. Select **Add Expense**.
2. Choose a **Category** and **Date**, then check the **Expense Number**.
3. Enter **Amount** and **Currency**. A customer and payment mode are optional when they help describe the transaction.
4. Add a note and attach a receipt if you have one.
5. Review the **Taxes** section and the **Gross**, **Input Tax** and **Net** summary.
6. Select **Save Expense**.

![InvoiceShelf 3 expense form](/images/v3/expense-create.webp)

## Organize and find expenses

Use the list filters to narrow the records. The row menu provides edit or delete actions when allowed by your role. Open **Settings → Expense Categories** to maintain the categories available on the form.

![InvoiceShelf 3 expense list](/images/v3/expenses.webp)

![InvoiceShelf 3 expense categories](/images/v3/categories.webp)

Receipt files depend on the configured [file storage](./file-disk.md). Include both the database and uploaded files in your [backup](./backups.md) procedure. For a printable breakdown, use the **Expenses** tab in [Reports](./reports.md).

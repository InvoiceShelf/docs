---
versions: ['2']
reviewed_against: 0287adf6472dd4fe0f6f731c966afcd685086bdb
reviewed_hash: 3e32f22753d05c95b5280864623718e600b0834c55cd8607603b5a3bbcc93d6c
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
5. Check the entered amount and currency before saving; this v2 form does not include the separate v3 input-tax panel.
6. Select **Save Expense**.

![InvoiceShelf 2 expense form](/images/v2/expense-create.webp)

## Organize and find expenses

Use the list filters to narrow the records. The row menu provides edit or delete actions when allowed by your role. Open **Settings → Expense Categories** to maintain the categories available on the form.

![InvoiceShelf 2 expense list](/images/v2/expenses.webp)

![InvoiceShelf 2 expense categories](/images/v2/categories.webp)

Receipt files depend on the configured [file storage](./file-disk.md). Include both the database and uploaded files in your [backup](./backups.md) procedure. For a printable breakdown, use the **Expenses** tab in [Reports](./reports.md).

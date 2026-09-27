---
versions: ['2']
reviewed_against: 0287adf6472dd4fe0f6f731c966afcd685086bdb
reviewed_hash: f4ca763b58bb7d02fd74b562e0f3ead65d00ff8bf233c490e0413b64465dc938
anchor_aliases:
  by-customer: sales-report
  by-item: sales-report
  profit-loss-report: profit-and-loss-report
---

# Reports

Open **Reports** for the selected company. Choose a report tab and date range, then select **Update Report**. Wait for the preview to finish before using **Download PDF**.

![InvoiceShelf 2 report filters and a rendered sales report](/images/v2/reports.webp)

## Sales report

Use the **Sales** tab and choose **By Customer** or **By Item** from **Report Type**. Customer grouping helps compare accounts; item grouping helps compare services or products. Check the range every time you generate a report.

## Profit and loss report

Select **Profit & Loss** for the period summary. Sales, receipts and expenses represent different events, so an unpaid invoice and a received payment can fall in different periods. Reconcile underlying documents when a total differs from your bank activity.

## Expenses report

Select **Expenses** to review spending over the range. Consistent [expense categories](./expenses.md) make this output more useful. Check that receipt dates and amounts were entered correctly before exporting.

## Taxes report

Select **Taxes** to inspect the recorded taxes for the period. The report reflects the [tax settings](./taxes.md) and documents you entered; it does not decide which rates apply to your business.

## Preview troubleshooting

A blank or failed preview can be a [PDF generation](./pdf-generation.md) problem. First try one ordinary invoice. If both fail, inspect the configured driver and server logs. If only one report fails, narrow the range and inspect the relevant source records.

# AI Assistants (MCP)

InvoiceShelf 3 can be used from AI assistants such as Claude, ChatGPT, Claude Code and Cursor. It speaks the [Model Context Protocol](https://modelcontextprotocol.io) (MCP): you connect an assistant once, pick the company it works in and what it may do, and then ask it things like "which invoices are overdue?" or "invoice Acme for 10 hours of consulting at 120 with VAT".

The assistant works through InvoiceShelf, not around it. It sees what your role in the company lets you see, every change goes through the same validation as the app's own forms, and InvoiceShelf does all the arithmetic, so totals match what the invoice form would show.

::: tip Availability
The MCP server arrives in InvoiceShelf 3.0.0-alpha.5. It is off until a super admin switches it on.
:::

## Switching it on

A super admin allows assistants under **Administration → Settings → AI connections**. The page shows the server address to hand out, for example `https://invoices.example.com/mcp`.

From the command line the same is:

```bash
php artisan mcp:enable    # php artisan mcp:disable switches it off again
```

Switching it off closes the server and its sign-in pages; connections that exist start working again when it is switched back on.

### Requirements

- **HTTPS.** Assistants refuse servers without it, and sign-in tokens would travel unencrypted. The admin page warns when the site is not served over HTTPS.
- **The right public address.** Assistants are sent to `APP_URL`, so it must be the address people use. Behind a reverse proxy, set `TRUSTED_PROXIES` as well (see the [Docker guide](/install/docker.md#trusted-proxies)) so InvoiceShelf knows the original request was HTTPS.
- **Signing keys.** Access is signed with a key pair. It is created in the storage folder the first time the server is switched on. With several app containers, or when you would rather manage secrets yourself, set `PASSPORT_PRIVATE_KEY` and `PASSPORT_PUBLIC_KEY` instead; the admin page shows which is in use.

## Connecting an assistant

Each user connects their own assistant. **Account settings → Connected apps** shows the server address and how to add it to:

| Assistant | How |
|---|---|
| Claude Code | `claude mcp add --transport http invoiceshelf https://invoices.example.com/mcp`, then `/mcp` in Claude Code to sign in |
| Claude (web and desktop) | Settings → Connectors → Add custom connector, and paste the server address |
| ChatGPT | Settings → Apps and Connectors → Advanced, turn on developer mode, then create a connector with the server address |
| Cursor | Add `{"mcpServers": {"invoiceshelf": {"url": "https://invoices.example.com/mcp"}}}` to `.cursor/mcp.json` |

The assistant opens InvoiceShelf in your browser. Sign in, then choose:

- **the company** the assistant works in. A connection works in one company only; connect again to use another.
- **the access**: *Read only* lets it look things up, *Read and write* also lets it create and change records, send documents and record payments.

The page leads with the address you will be sent back to, since an assistant's name is whatever it chose to call itself. Only continue if you started the connection from that address.

## What an assistant can do

It starts every conversation by reading the company's context: its currency, how taxes and discounts are applied, the tax types, payment methods, units, templates, custom fields and the next document numbers.

**With read access** it can search and read customers, items, invoices, credit notes, estimates, payments and expenses, list overdue invoices, and report figures: what was invoiced, received and spent over a period, what customers owe, and rankings of customers, items and expense categories.

**With write access** it can also:

- create and change customers and catalogue items;
- preview, create, change and copy invoices and estimates, mark them sent, accepted or completed, and turn an estimate into an invoice;
- record payments against invoices and record expenses.

The assistant describes a document (the customer, the lines, the taxes) and InvoiceShelf works out the number, the dates, the currency and rate, catalogue prices, and every discount, tax and total, exactly as the invoice form would. It is asked to preview a document and show it to you before creating it.

## Safety

- **Sending email and deleting need your say-so.** Emailing an invoice, estimate or receipt, and deleting an invoice, estimate, payment or expense, only happen when the assistant passes `confirm`, which it is told to do only after asking you. Without it nothing happens.
- **Limits.** A connection may make 30 changes a minute and send 20 emails an hour; a company is sent at most 100 emails a day through connected apps.
- **Your permissions apply.** An assistant can only do what your role in the company allows. A read-only connection never sees the tools that change data.
- **Everything is logged.** Each change and email is recorded with the connection, user, company, tool and the record it touched, and kept for a year.
- **You stay in control.** Under **Connected apps** you can make a connection read-only or disconnect it at once. To give an app write access again after making it read-only, disconnect it and connect it anew.
- **Starting over.** Replacing the signing keys on the admin page signs every assistant out; each has to connect again.

::: warning Updating from an image with a shipped key
When an update replaces an `APP_KEY` that shipped with an older Docker image, connected assistants are signed out as well and have to connect again.
:::

## Redirect domains

After you approve a connection, your browser returns to the assistant. Claude, ChatGPT and local addresses (used by Claude Code and Cursor) are allowed out of the box. To use another assistant, add its https address under **Where assistants may send you back** on the admin page.

## Troubleshooting

| Symptom | What to do |
|---|---|
| The assistant says the server is unreachable or returns 404 | The server is switched off. Ask a super admin to allow AI assistants. |
| Sign-in fails with a redirect error | The assistant's address is not allowed. Add it under redirect domains. |
| The assistant cannot create or change anything | The connection is read-only, or your role lacks the permission. Check **Connected apps**, then disconnect and connect again with *Read and write*. |
| The assistant suddenly asks you to sign in again | The signing keys were replaced, the connection was removed, or an update replaced a shipped `APP_KEY`. Connect again. |

---
versions: ['3']
reviewed_against: c4f6f8af2163fcc3a0c97d2046fcf22c1d47d0e7
reviewed_hash: 0f7761676adeac9a316a343d179f234fadc6615f6b016a17704b96fe97eba9dc
anchor_aliases:
  requirements: redirect-domains
  safety: ai-assistants-mcp
---

# AI assistants (MCP)

InvoiceShelf 3 includes an MCP server so a compatible assistant can work with your company’s data through authorized application tools. This is separate from the optional [AI Assistant module](./ai-assistant-module.md) inside InvoiceShelf and from **Ask AI in these docs**, which answers documentation questions and does not access your invoices.

## Switching it on

A super administrator opens **Administration → Settings → AI connections** and enables the server. Use the displayed address, such as `https://invoices.example.com/mcp`. Use HTTPS for real connections.

![InvoiceShelf 3 administrator AI connection settings](/images/v3/ai-connections.webp)

The equivalent operator commands are `php artisan mcp:enable` and `php artisan mcp:disable`. Disabling the server blocks access; review and revoke individual connections separately when access should be removed permanently.

## Connecting an assistant

Add the displayed MCP address in a client that supports remote MCP and its authorization flow. Sign in to InvoiceShelf, choose the company, review the requested read/write access and approve only the intended connection. Client-specific menu names can change; the InvoiceShelf approval screen is the authority for the company and permissions.

![InvoiceShelf 3 connected application settings](/images/v3/connected-apps.webp)

Manage or revoke the connection in **User Settings → Connected apps**. A connection does not gain permissions beyond your role in the chosen company.

## What an assistant can do

Read-only access supports questions about the company data exposed by the server’s tools. Write access can allow supported operations such as creating documents, with InvoiceShelf performing validation and arithmetic. Review the resulting customer, lines, dates and totals before sending a document. Do not grant write access merely to ask questions.

## Redirect domains

The administrator controls allowed OAuth redirect origins. Use exact trusted origins; wildcards are not accepted. Local desktop callback addresses and approved custom schemes are handled by the server’s registration rules.

## Troubleshooting

If connection discovery fails, check HTTPS, the MCP toggle and the exact endpoint. If authorization fails, check the registered redirect and selected company membership. If a tool is denied, inspect both the connection’s granted access and your role. Do not work around an authorization failure by sharing an administrator password with an assistant.

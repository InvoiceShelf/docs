---
versions: ['3']
reviewed_against: c4f6f8af2163fcc3a0c97d2046fcf22c1d47d0e7
reviewed_hash: b11535291ef5c593e374da5bfbab4cc7feff767decd4f9356e5a5a37175c1a08
---

# AI Assistant module

**AI Assistant** is an optional official module for InvoiceShelf 3. This guide
covers module **1.0.0** with the v3 host described by this book. It adds a chat drawer
and writing assistance inside InvoiceShelf.

This is separate from [external assistants connected through MCP](./ai-assistants.md)
and from **Ask AI** on the documentation website. The module's business-data tools
are read-only; an MCP connection may have separately approved write access, while
documentation answers do not access company records.

## Install and connect a provider

1. A super administrator installs and enables **AI Assistant** in
   **Administration → Modules**. See [Modules](./modules.md).
2. Open **Administration → Settings → AI Assistant**.
3. Enable **AI Assistant**, select **OpenRouter**, and enter the provider API key.
4. Enable the capabilities you want to offer and select a model for each one.
5. Select **Save settings**, then **Test connection**. The test control is shown
   when AI Assistant is enabled.

Your administrator supplies and funds the OpenRouter account. The module does not
include provider credit or a shared API key. Keep keys out of screenshots,
documents, and support messages.

## Choose capabilities

- **Assistant chat** makes the conversational drawer available on company pages.
  Use the AI header action to open it. Start a new conversation when changing topics.
- **Editor text generation** adds writing tools to supported rich-text editors.
  Review suggested text before using it in a document or email.

The capabilities can be enabled independently. If a control is missing, check the
module state, provider configuration, enabled capabilities, and your company access.

## Company-specific configuration

The administrator's configuration is the default. A company owner can open
**Company Settings → AI Assistant**, enable **Use a company-specific AI configuration**,
and choose a different provider configuration or models for that company.

Leaving that setting off uses the global configuration. Replacing a key updates the
stored key; leaving its masked value unchanged retains it.

## Data and permissions

Prompts and any business data requested through the module's read-only tools are
sent to OpenRouter and the selected model provider. Enable the module only with
provider and model choices appropriate for your business data.

Tools operate in the active company and respect the signed-in user's InvoiceShelf
permissions. The module cannot create or change invoices, expenses, customers,
payments, or other business records. Verify amounts and document details in the
application before acting on an answer.

API keys are encrypted at rest and masked in settings. An assistant response is not
a reason to share an administrator password or increase another user's permissions.

## Troubleshooting

If the connection test fails, check the provider key, available provider credit,
selected model, and provider URL. After changing settings, save and test again.

If chat cannot access a record, check the active company and your normal permission
to view that record. If only writing tools are missing, confirm **Editor text
generation** is enabled separately from chat.

## Disable or remove the module

Disabling hides the module's controls and routes but retains its configuration and
conversations. Uninstalling removes the package. Selecting **Remove module data**
also removes stored module settings and conversations; this is permanent.

See [Backups](./backups.md) before removing stored data.

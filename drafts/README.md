# Unreleased documentation

This directory holds user guides for features that are not included in the
published books' pinned releases. The website importer reads only `docs/`, so
these drafts do not enter published navigation, keyword search, or AI answers.

| Draft | Application work | Publication condition |
|---|---|---|
| [Bills and supplier payments](./v3/guide/purchasing.md) | [InvoiceShelf PR #903](https://github.com/InvoiceShelf/InvoiceShelf/pull/903) | Review against the release that includes purchasing. |

To publish a draft, verify the final implementation and UI against the target
release, move it into the appropriate versioned book, add navigation, and record
its real source review and hash. Update the book's baseline and screenshots when
advancing the release. Never label unreleased behavior as available in the current
book merely to pass validation.

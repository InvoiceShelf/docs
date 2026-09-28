# User-guide consolidation — 2026-09-28

The documentation source PR [#31](https://github.com/InvoiceShelf/docs/pull/31)
merged into `master`. The local starting tree matches merged commit
`b7c1584e7048357f7b9cd72d75382c663670c6f8`. Git fetch was unavailable during this
pass; the tree identity was verified through the GitHub API.

The website renderer lives in a separate PR,
[website #54](https://github.com/InvoiceShelf/website/pull/54), which was still open
when checked. Content merge, website deployment, and public-site cutover are
separate steps; none is inferred from another.

| Source | Canonical guide | Treatment |
|---|---|---|
| Existing v2/v3 documents | `docs/v2/`, `docs/v3/` | Already present in the merged source repository; preserved. |
| Tasks & Projects README usage | `docs/v3/guide/tasks-projects.md` | Reviewed against module 0.2.1 source and the alpha.10 extension runtime. |
| AI Assistant README usage | `docs/v3/guide/ai-assistant-module.md` | Reviewed against module 1.0.0 source; corrected setup order so the enabled-only Test connection control is described accurately. |
| App `docs/features/purchasing.md` | `drafts/v3/guide/purchasing.md` | Consolidated as unreleased content from current app PR commit `9fba5b7a`; not advertised in alpha.10. |
| App `mobile/README.md` | `docs/v3/mobile.md` | User-facing access/connection coverage already exists; native build and packaging details remain in the application README. |
| Website `docs/operations.md`, billing/domain launch notes | Website repository | Operational runbooks; outside user-guide consolidation. |
| App architecture decisions, module contributor guides, private specs/research | Owning repositories | Engineering documentation; retained with its source. |

The v2 book has no Tasks & Projects or AI Assistant module page because these
packages require v3. Both published release baselines are unchanged. No new
screenshots were introduced or relabelled; the existing captures retain their
release provenance. New module pages were reviewed from source. Browser review
of the new rendered pages remains required before marking visual QA complete.

The module READMEs and app development guide remain available as release/source
context. Cross-repository link-only replacements can follow after this docs change
lands, so published packages never point at missing guide URLs.

The purchasing draft was imported from the latest PR source rather than the older
local app checkout. In that source, recurring supplier costs and changes to the
existing Tax report are follow-ups, so the draft does not claim those features
are included.

# Documentation authoring

This repository owns InvoiceShelf documentation source. The website repository imports and renders it; there is no VitePress app or documentation Docker image.

- Keep content in `docs/**/*.md`, images in `docs/public/images/`, and sidebar order in `docs.json`.
- Use standard Markdown (headings, tables, fenced code, blockquotes, relative `.md` links). Raw HTML is escaped. Callouts are blockquotes with a bold introductory label. Local links and heading fragments must resolve.
- Front matter uses `title` (optional when H1 exists), `description`, `lang: en`, and `versions: ['2']`, `['3']`, or `[]` when applicability is unknown. Do not infer that an older guide applies to v3.
- Preserve existing paths and headings; links are public contracts. If a rename is necessary, coordinate website redirects.
- A guide is eligible for AI answers only when `rag_reviewed_hash` matches its body and versions. Verify advice against the relevant app checkout before recording a review. Use `php artisan docs:review-hash ../docs/docs/<page>.md` from the website checkout; add `reviewed_against` with the inspected app commit. Never refresh hashes solely to make a check pass.
- Screenshot tooling and the `capture-app-screenshots` agent skill live in `InvoiceShelf/devenv`. Read its `AGENTS.md` and `.agents/skills/capture-app-screenshots/SKILL.md`; use `make screenshot` or a named recipe. Capture actual UI from a matching app version, inspect the image, and commit its provenance sidecar. Never fabricate product UI or publish real customer data.
- Validate via `make docs-validate` in devenv, or `php artisan docs:validate ../docs` in website. Preview via `make docs-import` at `http://web.invoiceshelf.test/docs`.
- Master publishes automatically after validation. Publishing is handled by website CI credentials, not by agents manually writing its database. Changing a guide invalidates its AI review until reviewed again.

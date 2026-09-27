# InvoiceShelf documentation source

Markdown and images for [InvoiceShelf documentation](https://invoiceshelf.com/docs). Content stays in this repository; the Laravel website validates, imports, renders, and indexes it.

## Author and preview

Clone this repo with [InvoiceShelf/devenv](https://github.com/InvoiceShelf/devenv). From the devenv root:

```sh
make docs-validate
make docs-import
# Open http://web.invoiceshelf.test/docs
```

Contributors without the private devenv/website checkout can validate with public dependencies only:

```sh
composer --working-dir=.github/validator install
php .github/validator/validate.php .
```

Leave review hashes unchanged while editing; maintainers verify the changed advice before approving the new publication.

Without Docker, run `php artisan docs:validate ../docs` or `docs:import ../docs --no-index` in the website checkout. Neither requires an AI key. Navigation is defined by `docs.json`; Markdown stays under `docs/` and images under `docs/public/images/`.

Use Markdown relative links (`./mail.md#private-networks`). The website rewrites them to canonical `/docs/...` URLs. Images such as `/images/v3/dashboard.webp` become immutable stored assets. Validation catches broken paths, anchors, missing images and unsafe links before publication. Raw HTML is escaped; use Markdown equivalents.

## Screenshots

The screenshot CLI and agent skill live in devenv, outside application dependencies. Use `make screenshot ARGS='--help'` and the named recipes described in the skill. Capture real UI using isolated demo data, the guide's actual app version, a fixed viewport and readiness checks. Commit approved images and their `.capture.json` provenance files; cookies and credentials never belong here.

## Versioned books and review

`docs.json` schema 2 declares v2 (2.4.6) and v3 (3.0.0-alpha.10), with pinned
application commits and separate navigation. v3 is the default book and the only
source for AI answers. The reader routes are `/docs/v2/...` and `/docs/v3/...`;
`/docs` redirects to v3. Switching books keeps a matching topic, or opens the
selected book's overview with a notice. v2 offers keyword search and a link to v3
instead of an Ask AI tab.

Content lives in `docs/v2/` and `docs/v3/`. Relative links resolve within that book.
Use `/docs/v2/...` for an intentional link from v3 to older instructions. Existing
unversioned URLs use the manifest's redirect map, and `anchor_aliases` preserve
old heading bookmarks. Legacy screenshots remain available at their old paths.

```yaml
---
versions: ['3']
reviewed_against: c4f6f8af2163fcc3a0c97d2046fcf22c1d47d0e7
reviewed_hash: <digest printed by docs:review-hash>
anchor_aliases:
  old-heading: current-heading
---
```

After checking the advice against the pinned release, run
`php artisan docs:review-hash ../docs/docs/v3/guide/<name>.md` from website. The
hash covers body, versions and optional title. The importer requires a current
review for every page in both books; a stale review prevents publication of the
whole new revision. It does not remove the previous live revision.

`content-review.json` tracks rewritten topics, intentional version exclusions and
screenshot evidence. All current images were captured from the declared releases
in isolated fixtures, visually inspected and encoded as WebP. Version, commit,
dirty state and file hash are checked from each `.capture.json` sidecar. Update
text, screenshots and the catalog baseline together when reviewing another release.

## Publication

PRs run the website's canonical parser exported into `.github/validator/`, with its source revision and checksum in `source.json`. It includes only the parser and public Composer dependencies, so contributors need no access to the private website repo. Refresh it with `php artisan docs:export-validator ../docs/.github/validator` from website, then update its Composer lock when dependencies change. Validated pushes to `master` request an import by exact commit SHA and wait for publication. Failed imports preserve the previous revision. Embeddings are queued separately; ordinary docs and search continue during provider outages.

Configure `CI_DOCS_TOKEN` as a GitHub Actions secret with the same dedicated value in the website deployment. The token authorizes docs imports only. Initial rollout requires the website implementation and worker before this workflow is enabled. Operations, rollback, AI budgets and the old-host cutover are documented in the website's `docs/operations.md`.

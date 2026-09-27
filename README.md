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

Leave review hashes unchanged when editing a guide; maintainers verify the changed advice before approving it for AI answers.

Without Docker, run `php artisan docs:validate ../docs` or `docs:import ../docs --no-index` in the website checkout. Neither requires an AI key. Navigation is defined by `docs.json`; Markdown stays under `docs/` and images under `docs/public/images/`.

Use Markdown relative links (`./mail.md#private-networks`). The website rewrites them to canonical `/docs/...` URLs. Images such as `/images/dashboard.png` become immutable stored assets. Validation catches broken paths, anchors, missing images and unsafe links before publication. Raw HTML is escaped; use Markdown equivalents.

## Screenshots

The screenshot CLI and agent skill live in devenv, outside application dependencies. Use `make screenshot ARGS='--help'` and the named recipes described in the skill. Capture real UI using isolated demo data, the guide's actual app version, a fixed viewport and readiness checks. Commit approved images and their `.capture.json` provenance files; cookies and credentials never belong here.

## Versions and AI review

Guides remain readable and keyword-searchable even when their applicability is unknown. Declare verified major versions in front matter. Only content with a current review hash is used for AI answers:

```yaml
---
versions: ['3']
rag_reviewed_hash: <digest printed by docs:review-hash>
reviewed_against: <inspected application commit>
---
```

After checking the guide against that version, run `php artisan docs:review-hash ../docs/docs/guide/<name>.md` from website. The hash covers body and versions; any change invalidates it. Never automatically regenerate review hashes during CI. A small reviewed corpus is preferable to confident answers from outdated instructions.

## Publication

PRs run the website's canonical parser exported into `.github/validator/`, with its source revision and checksum in `source.json`. It includes only the parser and public Composer dependencies, so contributors need no access to the private website repo. Refresh it with `php artisan docs:export-validator ../docs/.github/validator` from website, then update its Composer lock when dependencies change. Validated pushes to `master` request an import by exact commit SHA and wait for publication. Failed imports preserve the previous revision. Embeddings are queued separately; ordinary docs and search continue during provider outages.

Configure `CI_DOCS_TOKEN` as a GitHub Actions secret with the same dedicated value in the website deployment. The token authorizes docs imports only. Initial rollout requires the website implementation and worker before this workflow is enabled. Operations, rollback, AI budgets and the old-host cutover are documented in the website's `docs/operations.md`.

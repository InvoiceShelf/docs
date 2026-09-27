# Documentation authoring

This repository owns source content; the website imports and renders it. There is
no VitePress application or docs Docker image.

- `docs.json` schema 2 declares separate books under `docs/v2/` and `docs/v3/`,
  their release/commit baselines, navigation and old-path redirects. v3 is default
  and the only AI collection; v2 retains ordinary navigation and keyword search.
- Use standard Markdown. Relative links stay inside the book. Use explicit
  `/docs/v2/...` or `/docs/v3/...` for intentional cross-version links. Raw HTML is
  escaped. Paths and heading fragments are public contracts: use `anchor_aliases`
  when rewriting a heading, and update the redirect map when moving a legacy path.
- Every page declares exactly its folder's `versions: ['2']` or `['3']`,
  `reviewed_against` equal to the catalog commit, and `reviewed_hash` for its current
  body/version/title. Verify actual advice against that release before recording
  a hash. Use `php artisan docs:review-hash ../docs/docs/v3/<page>.md` from website.
  Never regenerate hashes merely to pass CI. Versioned publication rejects stale
  review metadata; both books remain in the previous revision until validation passes.
- Update `content-review.json` with coverage, evidence and screenshots. Unsupported
  version-specific topics are explicitly marked not applicable, not copied across.
- Images live under `docs/public/images/v2/` or `v3/` and must come from the matching
  clean release checkout. Read devenv's screenshot skill, capture actual UI with
  isolated demo data, inspect the image, then commit its `.capture.json` sidecar.
  Do not fabricate UI or publish real customer data. Preserve older images for old URLs.
- Validate with `make docs-validate`, or the standalone `.github/validator/validate.php`.
  Preview with `make docs-import` at `http://web.invoiceshelf.test/docs`. Always
  inspect changed pages in the browser before reporting completion.
- Master publishes automatically only after validation. Website deployment precedes
  schema-2 content publication; no manual production database edits. Embeddings
  index reviewed v3 chunks only and must not delay v2 publication or keyword search.

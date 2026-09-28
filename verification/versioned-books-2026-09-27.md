# Versioned books verification

Baseline application worktrees were clean, detached releases:

- v2: 2.4.6, `0287adf6472dd4fe0f6f731c966afcd685086bdb`.
- v3: 3.0.0-alpha.10, `c4f6f8af2163fcc3a0c97d2046fcf22c1d47d0e7`.

The content inventory covers all 32 previous topics plus missing account, role,
module and font workflows. There are 33 v2 pages and 36 v3 pages. MCP is explicitly
not applicable to v2. Every page has a current review hash; every referenced image
belongs to the declared release and has a matching clean-source/hash sidecar.

71 fresh application screenshots (33 v2, 38 v3) were captured with isolated native
fixtures and inspected visually. Published files contain real UI, with WebP encoding
only. Old raster assets remain solely to preserve existing image URLs.

The website importer validated 69 documents and 107 assets. Browser verification
opened all 69 pages with zero broken article images, horizontal overflow or page
errors. Desktop and 390px mobile views were inspected. Checks exercised version
selection, scoped v2 search, hidden v2 Ask AI, v3 AI labeling, missing-topic fallback,
legacy .html redirects, retained heading fragments and counterpart anchors.

Both application baselines installed their locked PHP/Node dependencies and built
successfully. A disposable SQLite copy was migrated from v2 to v3: 5 customers,
12 invoices, 4 estimates, 4 payments, 3 expenses and 1 company retained their record
counts. The pre-migration copy was restored successfully. Invoice and estimate
`make:template` commands ran successfully under both releases. These checks are a
local migration rehearsal, not production or all-database certification. Herd and
native mobile packaging were source-reviewed, not executed on their target platforms.

Website regression coverage includes paired slugs, versioned URLs/search/citations,
review and screenshot rejection, atomic publication, removed pages, v3-only indexing,
v2-only edits reusing v3 vectors, old-version refusal before provider calls, versioned
rollback restrictions and PostgreSQL vector filtering. Provider responses are mocked.
A real-provider evaluation remains pending because no local `OPENAI_API_KEY` is set.

Production rollout is ordered: deploy website code/migration, publish schema-2 docs,
then evaluate/enable AI. Existing production deployment and ingress are unchanged.

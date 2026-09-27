---
versions: ['2']
reviewed_against: 0287adf6472dd4fe0f6f731c966afcd685086bdb
reviewed_hash: a53410902548e9f860bfb946b4390c8a4ab61f98aa52809546c0935a645a1206
anchor_aliases:
  developer-guide: developer-setup
  docker-environment: choose-an-environment
  laravel-herd: developer-setup
  manual-nginx-php-fpm: developer-setup
---

# Developer setup

The v2 application is maintained on the **`2.x`** branch. This documentation was checked against **2.4.6**. Use the tag to reproduce a documented screen; use the branch when contributing current changes to that line.

## Choose an environment

- [Docker development](./developer/docker.md) uses the application repository’s `./devenv` helper.
- [Laravel Herd](./developer/laravel-herd.md) uses a local PHP runtime and site manager.
- [Manual Nginx/PHP-FPM](./developer/manual.md) gives you direct control of the services.

Read the checkout’s `AGENTS.md` and contribution guidance before changing code. The v2 and v3 trees differ substantially; do not copy frontend imports or application namespaces between them.

## Install and verify

Both baselines use PHP 8.4, Node.js 24+ and `pnpm@11.6.0`; the locked dependencies determine the exact supported runtime. Run `composer install`, `pnpm install --frozen-lockfile` and `pnpm build` inside the selected checkout. The v2 frontend is JavaScript and uses its own component and store structure.

Use a dedicated test database for `php artisan test`. Read the release’s test configuration before running migrations or seeders. Never run `migrate:fresh` against an installation containing data you need.

## Screenshots and documentation

Capture the actual release under discussion with demonstration data. When changing a user-facing workflow, update the corresponding version’s guide and screenshot together. A screenshot from v3 is not evidence for a v2 instruction.

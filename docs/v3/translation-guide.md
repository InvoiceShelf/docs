---
versions: ['3']
reviewed_against: c4f6f8af2163fcc3a0c97d2046fcf22c1d47d0e7
reviewed_hash: 17515fa222243a7d0504cbab74de7224c012508d5e0a433556f06b9b89e026bb
anchor_aliases:
  translation-guide: translations
  step-1-go-to-crowdin: translations
  step-2-open-in-editor: translations
  step-3-select-language: translations
  step-4-start-translating: start-translating
---

# Translations

Translate the v3 application against the **3.x** source. The base messages live in `lang/en.json`; locale JSON files live alongside it. The Crowdin mapping in this release uses those files.

## Start translating

Choose the correct version branch when preparing a contribution. Compare the locale file with its `en.json`, preserve message keys and placeholders, and translate the displayed value. A key removed or renamed in v3 may still be needed by v2.

Keep interpolation placeholders intact and preserve intentional formatting. Prefer wording that fits buttons, tables and mobile layouts. Do not copy HTML into a message that expects plain text.

## Check in the application

Build the frontend, select the language in the application’s preferences, and open the affected screen. Verify plural forms, dates, long labels and right-to-left layout where applicable. A valid JSON file can still produce clipped or misleading UI.

PDF script coverage is separate from UI translation. Install the appropriate [font package](./guide/fonts.md) when a translated document uses characters outside the bundled fonts.

## Submit a change

Submit the translation through the project’s translation workflow or a pull request against the matching branch. Include the locale, affected screens and verification details. Documentation translations are separate from the application’s `lang` files.

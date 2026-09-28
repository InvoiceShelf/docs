---
versions: ['2']
reviewed_against: 0287adf6472dd4fe0f6f731c966afcd685086bdb
reviewed_hash: 8783a8b3d54244e65c5905d56ee7b9169b3c47ab61c1ec6c7ab912e9dbe865b1
anchor_aliases:
  translation-guide: translations
  step-1-go-to-crowdin: translations
  step-2-open-in-editor: translations
  step-3-select-language: translations
  step-4-start-translating: start-translating
---

# Translations

Translate the v2 application against the **2.x** source. The base messages live in `lang/en.json`; locale JSON files live alongside it. The Crowdin mapping in this release uses those files.

## Start translating

Choose the correct version branch when preparing a contribution. Compare the locale file with its `en.json`, preserve message keys and placeholders, and translate the displayed value. A key removed or renamed in v3 may still be needed by v2.

Keep interpolation placeholders intact and preserve intentional formatting. Prefer wording that fits buttons, tables and mobile layouts. Do not copy HTML into a message that expects plain text.

## Check in the application

Build the frontend, select the language in the application’s preferences, and open the affected screen. Verify plural forms, dates, long labels and right-to-left layout where applicable. A valid JSON file can still produce clipped or misleading UI.

PDF font coverage is separate from interface translation. Generate a document with representative names and addresses to confirm the selected renderer can draw those characters.

## Submit a change

Submit the translation through the project’s translation workflow or a pull request against the matching branch. Include the locale, affected screens and verification details. Documentation translations are separate from the application’s `lang` files.

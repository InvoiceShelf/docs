---
versions: ['3']
reviewed_against: c4f6f8af2163fcc3a0c97d2046fcf22c1d47d0e7
reviewed_hash: 91d624c934f9d8fc6cd7c6a4faf2b24553045673b5a451ec328555ef512e671e
---

# PDF font packages

PDF fonts are installed on the server and are separate from the fonts in the application interface. Version 3 bundles Noto Sans for Latin, Greek and Cyrillic and provides additional packages for other writing systems.

## Install a package

1. Enter **Administration → Settings → Font Packages** as a super administrator.
2. Locate the language or script required by your documents.
3. Select **Install** and wait for completion.
4. Render a document containing representative names, addresses and notes.

![InvoiceShelf 3 font packages with bundled and installable fonts](/images/v3/fonts.webp)

The screen lists packages for CJK languages, Hebrew, Arabic, Devanagari and Thai. Install what your documents need; CJK packages are larger than the bundled Latin fonts.

## Container and offline deployments

Operators can preinstall packages with `php artisan pdf:fonts:install --all`. The command supports a destination path for image builds; `PDF_FONTS_PATH` selects that location and `PDF_FONTS_DOWNLOAD=false` disables runtime downloads. Keep the font directory within the application directory required by the renderer and readable by the PHP user.

A disabled Install action can be an intentional deployment policy. Ask the server operator to supply the package rather than repeatedly attempting a blocked download.

## Verify output

Generate a real [invoice](./invoices.md) PDF and check for missing squares, incorrect shaping and clipped lines. A correctly translated interface does not prove the PDF has the necessary glyphs. Custom templates must use the supported font stack too.

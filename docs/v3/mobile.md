---
versions: ['3']
reviewed_against: c4f6f8af2163fcc3a0c97d2046fcf22c1d47d0e7
reviewed_hash: a09b62d3ae3e7565bb66eecd72eac66d749b56dbce24fa3eea8b34269f966a5d
anchor_aliases:
  mobile-apps: mobile-access
---

# Mobile access

You can open this InvoiceShelf release in a phone browser using your installation’s normal URL. Use HTTPS, sign in with your own account and check that the correct company is selected.

## Browser access

Open the application address rather than the documentation website. The server holds the data; signing out of the phone does not delete invoices or customer records. Protect the device and avoid sharing a staff session.

## Native client development

The v3 repository includes a Capacitor shell in `mobile/`. It packages the same frontend as a thin client; it does not contain a second database or backend. Native availability depends on a published, signed build for your platform. The presence of source code is not a promise of an App Store or Play Store release.

From a configured source checkout:

```bash
pnpm build:client
pnpm -C mobile install
pnpm -C mobile exec cap sync
```

Use Android Studio/SDK for Android or Xcode on macOS for iOS. Follow the pinned `mobile/README.md` for platform prerequisites. Keep the client and server versions compatible. Do not change the shell hostname `app.invoiceshelf.internal` to `localhost`: it participates in the bearer-authentication and CORS contract.

## Connection issues

Check the chosen server URL, certificate trust and server CORS configuration. A native-client authentication failure is not fixed by disabling CSRF protection on the web application.

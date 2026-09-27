---
versions: ['2']
reviewed_against: 0287adf6472dd4fe0f6f731c966afcd685086bdb
reviewed_hash: 32f1795dc3e1d588785aa389e143f7f58bda8cc4b839f1cbb3bc275426130b90
anchor_aliases:
  mobile-apps: mobile-access
---

# Mobile access

You can open this InvoiceShelf release in a phone browser using your installation’s normal URL. Use HTTPS, sign in with your own account and check that the correct company is selected.

## Browser access

Open the application address rather than the documentation website. The server holds the data; signing out of the phone does not delete invoices or customer records. Protect the device and avoid sharing a staff session.

## Native applications

The v2 application checkout does not contain v3’s Capacitor client. Do not apply the v3 mobile build commands to a v2 checkout or assume a v3 client is compatible with your server. Browser access is the documented route for this v2 baseline.

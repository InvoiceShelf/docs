---
versions: ['2']
reviewed_against: 0287adf6472dd4fe0f6f731c966afcd685086bdb
reviewed_hash: 7818fe0c2988b30d70ed16e7c0d7b4aa2c44f49b82717bf1bffaa7eae602173a
---

# Users and roles

Use the **Users** page to manage staff access. Customer portal logins are separate from staff users.

## Add access

Open **Users** and select **Add User**. Complete the identity and access fields, choose the appropriate role and save. Use a dedicated login for each person rather than sharing the administrator password.

![InvoiceShelf 2 users](/images/v2/members.webp)

## Define permissions

Open **Settings → Roles** and use **Add New Role** to define a named set of permissions. Assign the role when managing a user. Only give server-management abilities to people who need them.

![InvoiceShelf 2 role settings](/images/v2/roles.webp)

## Check the result

Sign in as the person or a dedicated test user and verify that the required pages and actions are available. A hidden navigation entry and a rejected action often indicate a missing permission or the wrong selected company. Removing staff access should also include reviewing any integrations or credentials that person controlled.

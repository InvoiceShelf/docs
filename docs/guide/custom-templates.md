# Custom Templates

The app provides a way to manage your own custom templates for Invoices and Estimates.

As of version [v2.1.0](https://github.com/InvoiceShelf/InvoiceShelf/releases/tag/2.0.0), the `make:template` command will create a new template in:
 
```bash
storage/templates/pdf/{invoice|estimate}/{template_name}.blade.php
```

This change ensures that custom templates are preserved during upgrades and remain intact when using Docker setups.

## Create Templates

There are two ways to customize or create the Invoice/Estimate templates described below.

### Manual template creation

To create a new template, you can manually create a `.blade.php` file in the following directories:

- **Invoices**: `storage/templates/pdf/invoice`
- **Estimates**: `storage/templates/pdf/estimate`

For each template, you need to specify template image in .png format with the same name as the template name.


### Using the `make:template` command

To quickly and easily generate a template either Invoices or Estimates, you can use the Laravel command:

```bash
php artisan make:template your-template-name
```

When using Docker, the equivalent command is:

```bash
docker compose exec invoiceshelf php artisan make:template your-template-name
```

The `make:template` command duplicates the default `invoice1` template shipped with the application, allowing you to customize it as needed.

## Automatic Detection of Templates

Any `.blade.php` file added directly to the above directories will automatically appear in the **Choose a Template** dialog, making it simple to select and use your custom designs.

![Custom Templates](/images/custom-templates.png)

---

This update ensures that templates are portable and upgrade-safe, especially for Docker-based deployments.

# Migration

This page explains how to migrate from the now abandoned Crater project.

The migration should be simple because there aren't huge differences between the two projects, so dropping your `storage` and the same database to InvoiceShelf then running `php artisan migrate` will be probably enough.

Step by step:

1. Download <a href="https://invoiceshelf.com/" target="_blank">InvoiceShelf</a> application.
2. Unzip InvoiceShelf ZIP that you downloaded to your website directory
3. Copy the old Crater's installation `storage` directory to InvoiceShelf website directory
4. Copy .env file from Crater's installation directory to InvoiceShelf website directory
5. Update .env and change it according to your wish, ultimately compare it with .env.example and see if you are missing anything.
6. Run `php artisan migrate` from the InvoiceShelf website directory

That's it! You are done.
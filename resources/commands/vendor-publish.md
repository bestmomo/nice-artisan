# vendor:publish

**Category**: Package Management / Customization

**Related**: config:publish, lang:publish, resources/views/vendor

---

## Description

The `vendor:publish` command is a vital Artisan utility in Laravel used to **copy publishable assets** from installed third-party packages or the Laravel framework itself into your application's directories.

This allows you to **customize files**—such as configuration files, migration files, views, public assets, or language files—that are normally stored within the read-only `vendor` directory. By publishing them, you create a local, editable copy that Laravel will use instead of the package's default version.

Packages must explicitly define which files are publishable and under what "tag" they are grouped.

---

## Usage

### Command Structure

`php artisan vendor:publish`

### Options

| Option | Description |
| :--- | :--- |
| **--provider** | Specifies the service provider class of the package whose files you want to publish (e.g., `Spatie\Backup\BackupServiceProvider`). |
| **--tag** | Specifies a particular **tag** of assets to publish (e.g., `config`, `views`, `migrations`, or a custom tag defined by the package). |
| **--force** | Overwrite any existing files in your application's directory without prompting for confirmation. |

---

## Practical Examples

1.  **List all available publishable assets from all packages and providers:**
    `php artisan vendor:publish`

2.  **Publish the configuration file for a package using its service provider:**
    `php artisan vendor:publish --provider="Illuminate\Mail\MailServiceProvider" --tag=config`

3.  **Publish all views for a specific package (assuming the package tagged its views as 'views'):**
    `php artisan vendor:publish --provider="Vendor\Package\ServiceProvider" --tag=views`

4.  **Publish all configuration files from ALL installed packages (a common deployment step):**
    `php artisan vendor:publish --tag=config`

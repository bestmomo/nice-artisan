# lang:publish

**Category**: Localization / Customization

**Related**: vendor:publish, config/app.php, resources/lang

---

## Description

The `lang:publish` command is an Artisan utility in Laravel used to **publish the language files** from the framework itself or from installed third-party packages into your application's primary language directory (`lang/` or `resources/lang/`).

This allows you to **customize the default translation strings** (like validation messages, pagination text, or authentication prompts) used by the framework or the package. By publishing them, the framework uses your local copy instead of the package's internal files.

---

## Usage

### Command Structure

`php artisan lang:publish`

### Action

When executed, the command checks for publishable language files and copies them to your application's language folder, typically organizing them by vendor namespace.

### Options

| Option | Description |
| :--- | :--- |
| **--id** | The package or vendor name whose language files you wish to publish. If omitted, all publishable language files are copied (including those from the Laravel framework). |
| **--force** | Overwrite existing language files in your application's directory without confirmation. |

---

## Practical Examples

1.  **Publish all publishable language files (framework and packages):**
    `php artisan lang:publish`

2.  **Publish only the language files for the core Laravel framework:**
    `php artisan lang:publish laravel`

3.  **Publish language files for a third-party package named 'cashier':**
    `php artisan lang:publish cashier`

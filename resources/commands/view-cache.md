# view:cache

**Category**: Performance / Views

**Related**: view:clear, config:cache, route:cache

---

## Description

The `view:cache` command is an Artisan utility in Laravel that **pre-compiles all your Blade template files** into raw PHP files.

Laravel normally compiles Blade templates on demand the first time they are rendered. By running this command during deployment, you eliminate this runtime compilation step for the end-user. This results in a small but noticeable performance improvement, especially on pages that render many views.

The compiled files are stored in the framework's cache directory (usually `storage/framework/views`).

---

## Usage

### Command Structure

`php artisan view:cache`

### Options

This command is typically run without any options during the deployment process.

| Option | Description |
| :--- | :--- |
| **--help** | Displays the help screen for the command. |

---

## Practical Examples

**Compile all Blade templates in the application:**

`php artisan view:cache`

**Part of a typical deployment script:**

#### ... deployment steps
`php artisan config:cache`

`php artisan route:cache`

`php artisan view:cache`

#### ... more deployment steps

# config:publish

**Category**: Configuration & Utilities

**Related**: vendor:publish, config:show, config:cache

---

## Description

The `config:publish` command is a convenience utility introduced to help developers add back configuration files that were removed or made optional in the default Laravel application skeleton (starting from Laravel 11).

It copies the framework's default configuration files for specific components (like `cors.php`, `hashing.php`, or `view.php`) from the core framework into your local application's `config/` directory. This allows you to easily customize those options if the default configuration in the framework is insufficient.

---

## When to Use This Command

- When you need to customize settings for a configuration file (like `hashing.php`) that is **not** present by default in your `config/` directory.
- As a faster alternative to manually copying a specific configuration file from the Laravel framework's source code.

---

## Basic Usage

When run without arguments, the command will present an interactive list of configuration files available for publishing, allowing you to select which one you need.

`php artisan config:publish`

---

## Available Options

| Option | Shortcut | Description |
| :--- | :--- | :--- |
| **--all** | | Publish **all** available optional configuration files into the `config/` directory. |
| **--force** | | Overwrite an existing configuration file if it already exists in `config/`. |

---

## Practical Examples

1.  **Publishing the View Configuration File:**
    ```bash
    php artisan config:publish view
    ```
    *(This copies the framework's default `view.php` file into `config/view.php`.)*

2.  **Publishing All Optional Configuration Files:**
    ```bash
    php artisan config:publish --all
    ```

### Note on `vendor:publish`

While `config:publish` handles core framework config files, the primary, all-encompassing command for publishing assets (including configuration) from **third-party packages** is still **`vendor:publish`**. Many packages require you to use this command with a specific provider or tag to get their config files.

```bash
# Example: Publishing a package's configuration file
php artisan vendor:publish --provider="PackageVendor\PackageName\PackageServiceProvider" --tag=config

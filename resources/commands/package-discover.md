# package:discover

**Category**: Package Management / Autoloading

**Related**: composer install, config/app.php

---

## Description

The `package:discover` command is an Artisan utility in Laravel used to **rebuild the list of packages** that support Laravel's **Package Discovery** feature.

Package Discovery is a modern Laravel feature that automatically registers a package's service providers, facades, and other assets without requiring manual configuration in the `config/app.php` file.

This command forces Laravel to scan the `vendor` directory and update the cached list of discoverable packages. It is rarely run manually because it is **automatically executed** by Composer after every `composer install` or `composer update` command. You would only run it if package discovery somehow failed or became corrupted.

---

## Usage

### Command Structure

`php artisan package:discover`

### Options

| Option | Description |
| :--- | :--- |
| **--except** | A comma-separated list of packages to exclude from the discovery process (i.e., prevent their service providers from being registered). |
| **--force** | Forces the discovery process to run, even if the application is currently in maintenance mode. |

---

## Practical Examples

1.  **Force the rediscovery of all installed packages:**
    `php artisan package:discover`

2.  **Discover packages but skip the service provider registration for a specific package:**
    `php artisan package:discover --except=laravel/cashier`

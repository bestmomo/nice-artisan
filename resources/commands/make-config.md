# make:config

**Category**: Configuration & Scaffolding

**Related**: config:cache, config:clear, vendor:publish

---

## Description

The `make:config` command is used to create a new configuration file in the `config/` directory of your Laravel application. These files are typically arrays of key-value settings that allow you to define various application parameters and options.

This command is particularly useful for organizing application-specific settings that don't belong in Laravel's core configuration files.

---

## When to Use This Command

- When creating a new service or package within your application that requires its own set of configurable options.
- When you want to cleanly separate custom application settings from the main `app.php`, `database.php`, or `services.php` files.
- To define default settings for a custom package before offering a `vendor:publish` option.

---

## Basic Usage

The command requires one argument: the desired name of the configuration file (without the `.php` extension).

`php artisan make:config settings`

---

## Available Options

| Option | Shortcut | Description |
| :--- | :--- | :--- |
| **--force** | | Create the file even if a configuration file with the given name already exists. |

---

## Practical Examples

Create a new configuration file named `app_settings.php`:
`php artisan make:config app_settings`

Overwrite an existing `api.php` configuration file:
`php artisan make:config api --force`

---

## Generated Configuration File

The command generates a file, for example `config/settings.php`, with the following base structure:

```php
<?php

return [
    // Configuration settings will be defined here.
    
    // Example:
    // 'status' => env('SETTINGS_STATUS', true),
];
```
The settings within this file can then be accessed throughout your application using the global config() helper:
```php
// Reading the 'status' key from config/settings.php
$status = config('settings.status');
```
#### Related Commands

* **config:cache** - Create a cache file for faster configuration loading.
* **config:clear** - Clear the configuration cache file.
* **vendor:publish** - Publish any publishable assets from vendor packages (often used to copy default config files into the config/ directory).

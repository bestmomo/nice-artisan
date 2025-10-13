# about

**Category**: Application Management / Introspection

**Related**: config:list, phpinfo(), dump-server

---

## Description

The `about` command is an essential Artisan utility in Laravel used to **display a detailed overview of the application's environment, configuration, and status**.

It provides a synopsis of many key pieces of information, often presented in categories, including:

1.  **Environment:** Laravel version, PHP version, Debug mode status.
2.  **Drivers:** Active cache, database, and session drivers.
3.  **Packages:** List of installed packages and their versions (often integrated via the `AboutCommand` class).
4.  **Configuration:** Details about application configuration like the app name and URL.

This command is invaluable for debugging, auditing, and providing necessary information when reporting issues or deploying the application. Packages can also extend the output of this command to show their own status or configuration details.

---

## Usage

### Command Structure

`php artisan about`

### Options

| Option | Description |
| :--- | :--- |
| **--only** | Filters the output to show only specific environment sections (e.g., `--only=drivers`). |
| **--json** | Outputs the complete application details as a raw JSON string. |

---

## Practical Examples

1.  **Display the full environment and configuration synopsis:**
    `php artisan about`

2.  **Display only the drivers and environment details in JSON format:**
    `php artisan about --only=drivers,environment --json`

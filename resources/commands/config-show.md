# config:show

**Category**: Configuration & Debugging

**Related**: config:cache, config:clear, about

---

## Description

The `config:show` command provides a detailed, human-readable dump of the current configuration values for a specified file or a single configuration key. It reads the **active** configuration—whether it's cached or loaded directly from the `config/` files—and presents it on the console.

This command is invaluable for **debugging** as it allows you to verify exactly what values the application is using, especially after running `config:cache` or when troubleshooting environment variable issues.

---

## When to Use This Command

- When you suspect a configuration setting is incorrect or has not been loaded properly from the `.env` file.
- To check the effective value of a configuration key in a production environment where configuration is cached.
- To quickly inspect the settings of a specific component (e.g., database connections, mail settings).

---

## Basic Usage

The command requires the name of the configuration file (without the `.php` extension), corresponding to a file in the `config/` directory.

`php artisan config:show app`

---

## Available Options

| Option | Shortcut | Description |
| :--- | :--- | :--- |
| **key** | | Specify a specific key within the configuration file using dot notation (e.g., `app.timezone`). |
| **database** | | **Shortcut** to view the entire `config/database.php` file. |

---

## Practical Examples

1.  **Show all settings in `config/app.php`:**
    ```bash
    php artisan config:show app
    ```

2.  **Show only the `timezone` value from `config/app.php`:**
    ```bash
    php artisan config:show app --key=timezone
    # Alternatively:
    # php artisan config:show app.timezone 
    ```

3.  **Show the default database connection details:**
    ```bash
    php artisan config:show database.connections.mysql
    ```

4.  **Show all file system disk definitions:**
    ```bash
    php artisan config:show filesystems.disks
    ```

---

## Output Example (Partial)
`$ php artisan config:show app.name`

_APP_NAME My Application

`$ php artisan config:show database.connections.mysql.host`

DATABASE_CONNECTIONS_MYSQL_HOST 127.0.0.1
## Related Commands

- **about** - Provides a broader overview of the application state, including environment and cached status.
- **config:cache** - The command that optimizes and compiles the configuration; `config:show` is used to verify the output of this process.
- **config:clear** - Clears the compiled configuration file.

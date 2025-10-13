# route:cache

**Category**: Performance / Routing

**Related**: route:clear, route:list, config:cache

---

## Description

The `route:cache` command is an Artisan utility in Laravel used to **compile the application's entire route registration** into a single, optimized file.

Laravel typically loads and registers all routes on every request by executing PHP code defined in files like `routes/web.php` and `routes/api.php`. This command speeds up the application significantly by replacing that process with a fast, static file read.

**Important Note:** Route caching **must only be used in production environments**. It is incompatible with closures (anonymous functions) used as route actions; all route actions must reference controller methods when route caching is active.

---

## Usage

### Command Structure

`php artisan route:cache`

### Cache Location

The compiled route file is saved in the `bootstrap/cache/routes-v7.php` (version number may vary) file.

### Options

| Option | Description |
| :--- | :--- |
| **--force** | Forces the command to run even if the application is not running in a production environment. |

---

## Practical Examples

1.  **Generate and cache the compiled route file (for production deployment):**
    `php artisan route:cache`

2.  **Force route caching in a non-production environment (use with caution):**
    `php artisan route:cache --force`

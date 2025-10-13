# make:cache-table

**Category**: Database & Caching

**Related**: cache:clear, migrate, config:cache

---

## Description

The `make:cache-table` command generates a database migration that creates a table specifically designed to store cached key-value pairs. This setup is necessary when you configure your Laravel application to use the **`database`** cache driver.

The database cache driver provides a persistent and centralized cache store, suitable when external solutions (like Redis or Memcached) are unavailable or when leveraging your existing database infrastructure is preferred.

---

## When to Use This Command

- When setting the cache driver to **`database`** in your `config/cache.php` or your `.env` file.
- When you need a simple, reliable, and shared cache backend that uses your existing database connection.

---

## Basic Usage

The command generates the migration file; it does not execute the migration.

`php artisan make:cache-table`

---

## Available Options

| Option | Shortcut | Description |
| :--- | :--- | :--- |
| **--table** | | Specifies a custom name for the cache table. The default name is **`cache`**. |

---

## Practical Examples

Default cache table name (`cache`):
`php artisan make:cache-table`

Custom cache table name (`app_cache`):
`php artisan make:cache-table --table=app_cache`

---

## Generated Migration File

This command creates a migration file (e.g., `xxxx_xx_xx_xxxxxx_create_cache_table.php`) in your `database/migrations` directory with the following structure:

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cache', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->mediumText('value');
            $table->integer('expiration');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cache');
    }
};

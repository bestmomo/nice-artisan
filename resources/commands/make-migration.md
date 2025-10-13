# make:migration

**Category**: Code Generation & Database

**Related**: migrate, migrate:status, make:model

---

## Description

The `make:migration` command creates a new **Migration Class** file in your `database/migrations` directory. Migrations are like version control for your database, allowing you to define the structure of your database (tables, columns, indexes) using PHP code instead of raw SQL.

This command is central to collaborating on a database schema and ensuring that the schema can be consistently rebuilt across development, staging, and production environments.

---

## When to Use This Command

- When adding a new table to your application's database schema.
- When modifying an existing table (e.g., adding or renaming columns, changing types).
- When creating or dropping indexes, foreign key constraints, or full-text search indexes.
- Whenever a database change is required to support a new application feature.

---

## Basic Usage

The command requires a descriptive name for the migration. Use a name that clearly explains what the migration does.

`php artisan make:migration create_products_table`

---

## Available Options

| Option | Shortcut | Description |
| :--- | :--- | :--- |
| **--create** | | Indicates that the migration should create a new table, automatically adding the `Schema::create` boilerplate. |
| **--table** | | Indicates that the migration should modify an existing table, automatically adding the `Schema::table` boilerplate. |
| **--path** | | The location where the migration file should be created (relative to the base path). |
| **--realpath** | | Indicate any provided path is pre-resolved to an absolute path. |
| **--force** | | Force the operation to run when in production. |

---

## Practical Examples

Create a migration to build a new table:
`php artisan make:migration create_orders_table --create=orders`

Create a migration to add a new column to an existing table:
`php artisan make:migration add_price_to_products_table --table=products`

Create a migration linked to a model (often done via `make:model -m`):
`php artisan make:migration create_posts_table --create=posts`

---

## Generated Migration File

The command generates a file, for example `database/migrations/2025_10_12_000000_create_products_table.php`, with the following structure (when using `--create=products`):

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            // $table->string('name'); 
            // $table->decimal('price', 8, 2); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
```
### Next Step: Running Migrations

After creating the migration file, you must run it to apply the changes to the database:
`php artisan migrate`

## Related Commands

* **migrate** - Runs all pending migrations.
* **migrate:rollback** - Reverts the last batch of migrations.
* **migrate:status** - Shows the status of all migrations (ran or pending).
* **make:model** - Often used simultaneously with the -m flag to generate the corresponding migration file.

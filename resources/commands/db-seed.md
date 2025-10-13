# db:seed

**Category**: Database & Development

**Related**: migrate, migrate:fresh, make:seeder, factory

---

## Description

The `db:seed` command is used to run your application's **database seeders**. Seeders are PHP classes that contain logic to populate your database tables with initial or dummy data. This is essential for:

1.  **Initial Setup:** Inserting static data, like countries, user roles, or default settings.
2.  **Development/Testing:** Populating the database with sufficient data (often generated via **Factories**) to test features and develop the application.

By default, this command executes the **`DatabaseSeeder`** class, which, in turn, calls other seeders you define.

---

## When to Use This Command

- After running migrations for the first time on a fresh database.
- During development when you need to quickly reset the application's data.
- After running `php artisan migrate:fresh` (which typically executes `db:seed` automatically).

---

## Basic Usage

The simplest form runs the master seeder class (`DatabaseSeeder`).

`php artisan db:seed`

---

## Available Options

| Option | Shortcut | Description |
| :--- | :--- | :--- |
| **--class** | **-c** | Specify a single seeder class to run instead of the default `DatabaseSeeder`. |
| **--force** | | Force the operation to run when in a production environment (requires confirmation otherwise). |

---

## Practical Examples

1.  **Run the master seeder class (standard use):**
    ```bash
    php artisan db:seed
    ```

2.  **Run a specific seeder class (e.g., to add roles without touching users):**
    ```bash
    php artisan db:seed --class=RolesTableSeeder
    # Or, using the shortcut:
    php artisan db:seed -c=RolesTableSeeder
    ```
    *Note: When using `--class`, you should not include the namespace if the seeder is in the default `database\seeders` directory.*

3.  **Run the full seeding process and suppress the safety prompt in production (use with extreme caution):**
    ```bash
    php artisan db:seed --force
    ```

---

## Seeding Structure (The Master Seeder)

Your master seeder, `database/seeders/DatabaseSeeder.php`, defines which seeders are executed when you run `db:seed`:

```php
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Executes all listed seeder classes in order
        $this->call([
            UserSeeder::class,
            RolesAndPermissionsSeeder::class,
            PostSeeder::class,
        ]);
    }
}
```
## Related Commands

* **make:seeder** - Generates a new seeder class file in the `database/seeders` directory.
* **migrate:fresh** - Drops all tables from the database and runs all migrations, then executes `db:seed`.
* **db:wipe** - Removes all tables, views, and foreign keys from the database.

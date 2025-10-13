# migrate:status

**Category**: Database Management / Migration Introspection

**Related**: migrate, migrate:rollback

---

## Description

The `migrate:status` command is an Artisan utility in Laravel that displays the **status of all migration files** in your application.

It generates a clear table showing every migration file, whether it has been run, and if so, which **batch** it belongs to. This is the primary tool for checking the current state of your database schema against your migration files.

---

## Usage

### Command Structure

`php artisan migrate:status`

### Output

The command produces a table with three columns:

| Column | Description |
| :--- | :--- |
| **Ran?** | Indicates if the migration has been executed (`Yes` or `No`). |
| **Batch** | The number of the batch in which the migration was run (if applicable). |
| **Migration** | The filename of the migration. |

### Options

| Option | Description |
| :--- | :--- |
| **--database** | Specifies the database connection to use for checking the migration status. |
| **--path** | Specifies the path(s) to the migration files if they are not in the default `database/migrations` directory. |

---

## Practical Example

**Check the status of all migrations:**
php artisan migrate:status

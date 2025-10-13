# migrate:reset

**Category**: Database Management / Migration

**Related**: migrate:rollback, migrate:refresh, migrate

---

## Description

The `migrate:reset` command is an Artisan utility in Laravel that executes the equivalent of **running `php artisan migrate:rollback` repeatedly** until **all migrations have been reverted**.

The key difference with `migrate:rollback` is that `migrate:reset` does not stop at the last batch; it iterates through the `migrations` table and executes the `down()` method for *every* migration that has been applied, in reverse order, until the database is in its initial state (empty, except for the `migrations` table).

This command is mainly used to completely clean the database of all structures created by migrations.

---

## Usage

### Command Structure

`php artisan migrate:reset`

### Options Courantes

| Option | Description |
| :--- | :--- |
| **--force** | Forces the command to run in a production environment. **⚠️ Warning: This action is destructive and irreversible.** |
| **--database** | Specifies the database connection to use. |
| **--path** | Specifies the path(s) where migration files should be searched for (if not the default directory). |

---

## Practical Example

**Cancel all migrations that have been executed:**
`php artisan migrate:reset`

**Cancel all migrations on a specific connection:**
`php artisan migrate:reset --database=tenant_db`

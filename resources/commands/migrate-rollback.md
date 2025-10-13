# migrate:rollback

**Category**: Database Management / Migration

**Related**: migrate, migrate:reset, migrate:refresh

---

## Description

The `migrate:rollback` command is an Artisan utility in Laravel used to **revert the latest "batch" of migrations** that were executed.

It does this by looking at the `migrations` table, identifying the last group (batch) of migrations run, and executing the `down()` method for each migration file in that group, in reverse order. This operation removes the changes made by that specific batch from the database schema.

---

## Usage

### Command Structure

`php artisan migrate:rollback`

### Options Courantes

| Option | Description |
| :--- | :--- |
| **--step** | Rolls back a specific number of previous migration batches instead of just the last one. |
| **--step=N** | Rolls back the last **N** batches of migrations. |
| **--pretend** | Displays the SQL queries that would be executed by the rollback without actually executing them on the database. |
| **--force** | Forces the command to run in a production environment. **⚠️ Danger: Cette action est destructrice.** |
| **--database** | Specifies the database connection to use. |
| **--path** | Specifies the path(s) where migration files should be searched for. |

---

## Practical Examples

1.  **Cancel the last batch of migrations:**
    `php artisan migrate:rollback`

2.  **Cancel the last 3 migration batches:**
    `php artisan migrate:rollback --step=3`

3.  **Display SQL rollback queries without executing the command:**
    `php artisan migrate:rollback --pretend`

# db:wipe

**Category**: Database & Development

**Related**: migrate:fresh, migrate:reset, db:seed

---

## Description

The `db:wipe` command is a powerful utility that completely **removes all tables, views, and foreign key constraints** from the specified database connection.

This command effectively reverts the database to a blank state, as if the schema had never been migrated. It is faster than running `migrate:reset` followed by `migrate` because it bypasses the need to track and reverse individual migration steps.

---

## When to Use This Command

- **Development:** When you need a completely clean slate before re-running all migrations and seeders (`migrate:fresh` often uses this internally).
- **Testing:** To quickly clean a testing database between test suites.
- **Troubleshooting:** When you suspect a data or schema corruption issue that requires a full database rebuild.

---

## Basic Usage

The command executes immediately, deleting all contents of the **default database connection**.

`php artisan db:wipe`

---

## Available Options

| Option | Shortcut | Description | 
| :--- | :--- | :--- | 
| **--database** | | Specify a connection name (as defined in `config/database.php`) to wipe, instead of the default one. | | **--force** | | Force the operation to run without prompting for confirmation, even in a production environment. |

---

## Practical Examples

1.  **Wipe the default database (requires interactive confirmation):**
    ```bash
    php artisan db:wipe
    ```

2.  **Wipe a testing database without confirmation:**
    ```bash
    php artisan db:wipe --database=testing --force
    ```

3.  **Perform a fresh setup (Wipe + Migrate + Seed) in a single command:**
    ```bash
    php artisan migrate:fresh
    ```
    *Note: The `migrate:fresh` command is generally preferred for a clean reset, as it includes the necessary re-migration and seeding steps.*

---

## Warning: Production Use

Due to its destructive nature, `db:wipe` is protected by a confirmation prompt. If executed in an environment where the `APP_ENV` is set to `production`, you must explicitly pass the `--force` flag to proceed. **Use this flag with extreme caution, as it will instantly destroy all data on the target database.**

---

## Related Commands

- **migrate:fresh** - Runs `db:wipe` followed by `migrate` and `db:seed`. This is the common "reset" command.
- **migrate:reset** - Rolls back all of the application's migrations (safer, but slower).
- **db:seed** - Populates the database with initial data after the tables have been created.

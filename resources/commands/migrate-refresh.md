# migrate:refresh

**Category**: Database Management / Migration

**Related**: migrate:rollback, migrate:fresh, db:seed

---

## Description

The `migrate:refresh` command is an Artisan utility in Laravel that executes a **full rollback of all migrations** and then **re-runs all of them** from the beginning.

It performs the following two sequential actions:

1.  **Rollback All**: Runs `php artisan migrate:rollback` repeatedly until all migrations have been reverted.
2.  **Re-run Migrations**: Runs `php artisan migrate` to reapply all migrations in order.

This command is commonly used during development to quickly apply changes made to migration files or to reset the schema without losing the migration history (unlike `migrate:fresh`, which deletes all tables regardless of migration status).

---

## Usage

### Command Structure

php artisan migrate:refresh

### Available Options
* --database: The database connection to use
* --path: The path(s) to the migrations files to be executed (multiple values allowed)
* --realpath: Indicate any provided migration file paths are pre-resolved absolute paths
* --seed: Indicates if the seed task should be re-run
* --seeder: The class name of the root seeder
* --step: Force the migrations to be run so they can be rolled back individually

---

## Practical Examples

1.  **Roll back all migrations and re-execute them:**
    `php artisan migrate:refresh`

2.  **Update the database and populate it with seeding data:**
    `php artisan migrate:refresh --seed`

3.  **Update only the last 3 migration batches:**
    `php artisan migrate:refresh --step=3`

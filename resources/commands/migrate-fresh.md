# migrate:fresh

**Category**: Database Management / Migration

**Related**: migrate, migrate:rollback, db:seed

---

## Description

The `migrate:fresh` command is an Artisan utility in Laravel used to **reset the entire database and re-run all migrations from scratch**.

It performs the following sequence of actions:

1.  **Drop All Tables**: It deletes every table in the connected database.
2.  **Run Migrations**: It executes the `php artisan migrate` command, running all migration files in order.

This command is typically used during **development or testing** when you need a completely clean database schema to work with, as it's often faster and simpler than running `migrate:reset` followed by `migrate`.

---

## Usage

### Command Structure

`php artisan migrate:fresh`

### Available Options
* --database: The database connection to use
* --drop-views: Drop all tables and views
* --drop-types: Drop all tables and types (Postgres only)
* --force: Force the operation to run when in production
* --path: The path(s) to the migrations files to be executed (multiple values allowed)
* --realpath: Indicate any provided migration file paths are pre-resolved absolute paths
* --schema-path: The path to a schema dump file
* --seed: Indicates if the seed task should be re-run
* --seeder: The class name of the root seeder
* --step: Force the migrations to be run so they can be rolled back individually

## Practical Examples

**Drop tables and rebuild the schema:**

`php artisan migrate:fresh`

**Drop tables, rebuild schema, and populate with dummy data**:

`php artisan migrate:fresh --seed`

**Perform the fresh migration and only run a specific seeder:**

`php artisan migrate:fresh --seed --seeder=UserSeeder`

**Force the command to run on a production server (dangerous!)**:

`php artisan migrate:fresh --force`

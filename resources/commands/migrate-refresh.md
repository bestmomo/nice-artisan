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

### Options

| Option | Description |
| :--- | :--- |
| **--seed** | Instructs Laravel to run the database seeders after the migrations are re-applied. |
| **--seeder** | Specifies a particular seeder class to run instead of the default `Database\Seeders\DatabaseSeeder`. Only valid when using `--seed`. |
| **--step** | Rolls back and re-applies only the last **N** batches of migrations. |
| **--force** | Forces the command to run in a production environment. **⚠️ Danger: This will destroy and rebuild your schema.** |
| **--database** | Specifies the database connection to use for the operation. |

---

## Practical Examples

1.  **Roll back all migrations and re-execute them:**
    `php artisan migrate:refresh`

2.  **Update the database and populate it with seeding data:**
    `php artisan migrate:refresh --seed`

3.  **Update only the last 3 migration batches:**
    `php artisan migrate:refresh --step=3`

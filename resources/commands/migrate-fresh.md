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

### Options Courantes

| Option | Description |
| :--- | :--- |
| **--seed** | Instructs Laravel to run the database seeders after the migrations are complete. This is the most common way to use the command. |
| **--seeder** | Specifies a particular seeder class to run instead of the default `Database\Seeders\DatabaseSeeder`. Only valid when using `--seed`. |
| **--force** | Forces the command to run in a production environment. **⚠️ Use with extreme caution, as it will destroy all data.** |
| **--path** | Specifies the path(s) to the migration files if they are not in the default `database/migrations` directory. |
| **--database** | Specifies the database connection to use if it's not the default connection. |

## Practical Examples

**Drop tables and rebuild the schema:**

`php artisan migrate:fresh`

**Drop tables, rebuild schema, and populate with dummy data**:

`php artisan migrate:fresh --seed`

**Perform the fresh migration and only run a specific seeder:**

`php artisan migrate:fresh --seed --seeder=UserSeeder`

**Force the command to run on a production server (dangerous!)**:

`php artisan migrate:fresh --force`

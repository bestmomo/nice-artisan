# schema:dump

**Category**: Database Management / Performance

**Related**: migrate, schema:load, db:seed

---

## Description

The `schema:dump` command is an Artisan utility in Laravel used to **dump the current database schema** into a single, static SQL or JSON file.

When you run migrations, Laravel executes numerous PHP files to build the schema. When the application runs, it also needs to introspect the database to build the schema structure. By dumping the schema, you create a dedicated file (e.g., `database/schema/mysql-schema.sql`) that can be quickly loaded into a clean database.

This is primarily used to speed up automated testing and deployment, especially in large applications with many migrations. Instead of running hundreds of migration files, Laravel can simply load the single schema dump file.

---

## Usage

### Command Structure

`php artisan schema:dump`

### Options

| Option | Description |
| :--- | :--- |
| **--database** | The database connection to use for dumping the schema. |
| **--prune** | Deletes all existing migration files after the schema has been successfully dumped. **⚠️ Use with caution!** |

---

## Practical Examples

1.  **Dump the current database schema to a file:**
    `php artisan schema:dump`

2.  **Dump the schema and then delete all existing migration files (assuming they are no longer needed):**
    `php artisan schema:dump --prune`

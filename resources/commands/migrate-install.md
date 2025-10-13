# migrate:install

**Category**: Database Management / Migration Setup

**Related**: migrate, migrate:status

---

## Description

The `migrate:install` command is an Artisan utility in Laravel used to **create the migration repository table** (usually named `migrations`) in your database.

This table is essential as it tracks which migration files have already been executed. **Note**: This command is generally not run manually, as the `php artisan migrate` command will automatically create this table if it doesn't exist. It is mainly used to explicitly specify a database connection for the repository table creation.

---

## Usage

### Command Structure

`php artisan migrate:install`

### Options

| Option | Description |
| :--- | :--- |
|**--database**	|The database connection to use for creating the migration table, if it's not the default connection.|

## Practical Example

**Create the migration repository on a specific connection:**

php artisan migrate:install --database=tenant_db


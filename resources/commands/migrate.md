# migrate

**Category**: Database

**Related**: make:migration, migrate:rollback, migrate:status

## Description
Executes all pending database migrations to update your database schema.

## When to Use This Command
- After pulling new code that includes migrations
- When deploying to production
- After creating new migrations with make:migration

## Basic Usage
php artisan migrate

## Important Notes
- Always backup your database before running in production
- Test migrations in development first

## Available Options
* --database: The database connection to use
* --force: Force the operation to run when in production
* --path: The path to the migrations files to be executed
* --realpath: Indicate any provided migration file paths are pre-resolved absolute paths
* --schema-path: The path to a schema dump file

## Practical Examples
Run all pending migrations:
`php artisan migrate
`
Run for specific database:
`php artisan migrate --database=mysql2`

Force run in production:
`php artisan migrate --force`

Run specific migration files:
`php artisan migrate --path=database/migrations/2024_01_*`

## Related Commands
- make:migration - Create new migrations
- migrate:rollback - Rollback the last migration operation
- migrate:status - Show the status of each migration
- migrate:fresh - Drop all tables and re-run all migrations

# db:table

**Category**: Database & Inspection

**Related**: db:show, migrate:status, schema:dump

---

## Description

The `db:table` command displays a detailed, human-readable breakdown of the schema for a **single specified database table**. It provides comprehensive information on columns, data types, indexes, and foreign key constraints for that table.

This command is a powerful **debugging and reference tool** that lets you instantly verify the precise structure of a table as defined and used by your active database connection.

---

## When to Use This Command

- **Schema Verification:** To quickly check if an expected column, data type, or index exists on a table after running migrations.
- **Debugging Queries:** To verify the data types and constraints before writing complex queries.
- **Development Reference:** To look up the detailed schema of a table without opening a database management client (like TablePlus or MySQL Workbench).

---

## Basic Usage

The command requires the **name of the table** you wish to inspect.

`php artisan db:table users`

---

## Available Options

| Option | Shortcut | Description |
| :--- | :--- | :--- |
| **--database** | | Specify a connection name (as defined in `config/database.php`) to inspect, instead of the default one. |

---

## Practical Examples

1.  **Show the schema details for the `products` table:**
    ```bash
    php artisan db:table products
    ```

2.  **Show the schema details for the `orders` table using a secondary connection named `reporting`:**
    ```bash
    php artisan db:table orders --database=reporting
    ```

---

## Output Overview (Conceptual)

The output is structured into distinct, informative sections:

### 1. Columns

This section lists every column, detailing:

| Column Header | Description |
| :--- | :--- |
| **Name** | The column name (e.g., `user_id`, `email`). |
| **Type** | The database-specific data type (e.g., `BIGINT(20)`, `VARCHAR(255)`). |
| **Required** | Whether the column is non-nullable (`YES` or `NO`). |
| **Default** | The default value set in the database, if any. |

### 2. Indexes

This section details all defined indexes:

| Index Header | Description |
| :--- | :--- |
| **Name** | The name of the index (e.g., `PRIMARY`, `users_email_unique`). |
| **Columns** | The columns covered by the index. |
| **Type** | The index type (e.g., `PRIMARY`, `UNIQUE`, `FULLTEXT`). |

### 3. Foreign Keys

This section lists any foreign key constraints:

| FK Header | Description |
| :--- | :--- |
| **Name** | The constraint name (e.g., `posts_user_id_foreign`). |
| **Columns** | The local column(s) (e.g., `user_id`). |
| **References** | The foreign table and column referenced (e.g., `users.id`). |
| **On Delete** | The action taken on delete (e.g., `CASCADE`, `RESTRICT`). |

---

## Related Commands

- **db:show** - Provides a high-level summary of the entire database (all tables, size, connections).
- **migrate:status** - Shows the run status of the application's migration files.
- **db:monitor** - Monitors the number of open database connections.

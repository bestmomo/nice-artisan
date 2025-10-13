# db:show

**Category**: Database & Inspection

**Related**: db:monitor, db:table, migrate:status

---

## Description

The `db:show` command provides a high-level, human-readable summary of a specified database connection. This command queries the database system directly to extract comprehensive details about its current state, structure, and usage.

It's an excellent diagnostic tool for instantly checking the health and configuration of your database without needing to connect through a dedicated client.

---

## When to Use This Command

- **Database Overview:** To quickly check the overall health, connection, and table summary of your database.
- **Connection Debugging:** To verify that Laravel is connecting to the correct database instance and using the expected credentials.
- **Resource Monitoring:** To see real-time statistics like the total number of tables, views, and the count of currently open connections.

---

## Basic Usage

The command displays details for the **default database connection** defined in your `.env` file and `config/database.php`.

`php artisan db:show`

---

## Available Options

| Option | Shortcut | Description |
| :--- | :--- | :--- |
| **--database** | | Specify a connection name (as defined in `config/database.php`) to inspect, instead of the default one. |

---

## Practical Examples

1.  **Show the summary for the default connection:**
    ```bash
    php artisan db:show
    ```

2.  **Show the summary for a secondary PostgreSQL connection:**
    ```bash
    php artisan db:show --database=pgsql
    ```

---

## Output Overview

The command presents several key sections, similar to the following (details vary by driver: MySQL, PostgreSQL, SQLite):

| Section | Content Displayed |
| :--- | :--- |
| **Connection** | Driver, Host, Port, Database Name |
| **Status** | Database size, Uptime, Current open connections |
| **Summary** | Total number of Tables, Views, and stored Procedures |
| **Table List** | A summary table listing all tables with their **size** and **row count** (rows is often unavailable on cloud-hosted databases due to permissions or performance constraints). |

## Related Commands

- **db:table [table]** - Provides a detailed schema and index breakdown for a **single table**.
- **db:monitor** - Actively monitors the number of open connections and dispatches an event if a limit is exceeded.
- **migrate:status** - Shows the current status (ran or pending) of all migration files.

# queue:flush

**Category**: Queue Management / Failure Handling

**Related**: queue:failed, queue:forget, queue:retry

---

## Description

The `queue:flush` command is an Artisan utility in Laravel used to **delete all entries** from the application's **failed jobs repository** (the `failed_jobs` database table by default).

This command is a quick way to clear the entire log of jobs that have failed and exhausted their maximum number of retries.

**Important Note:** This command **only** affects the record of *failed* jobs. It **does not** delete jobs currently waiting in the active queues (for that, you should use the `queue:clear` command).

---

## Usage

### Command Structure

`php artisan queue:flush`

### Options

This command is typically run without any options as its purpose is to clear the entire failed jobs table.

| Option | Description |
| :--- | :--- |
| **--database** | Specifies the database connection to use for accessing the `failed_jobs` table. |
| **--force** | Forces the command to run in a production environment without confirmation. |

---

## Practical Example

**Delete all records of failed jobs from the database:**
`php artisan queue:flush`

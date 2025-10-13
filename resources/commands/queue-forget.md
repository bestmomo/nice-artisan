# queue:forget

**Category**: Queue Management / Failure Handling

**Related**: queue:failed, queue:retry, queue:flush

---

## Description

The `queue:forget` command is an Artisan utility in Laravel used to **delete a single, specific failed job** from the failed jobs repository (the `failed_jobs` database table).

This command requires the **ID** of the failed job as an argument. The job ID can be retrieved by running the `php artisan queue:failed` command. It is used when a specific failed job is determined to be non-recoverable, broken, or should simply be ignored and removed from the failure log without affecting other failed jobs.

---

## Usage

### Command Structure

`php artisan queue:forget <id>`

### Arguments

| Argument | Description |
| :--- | :--- |
| **id** | The **unique ID** of the failed job to be deleted from the `failed_jobs` table. This ID is displayed by the `queue:failed` command. |

### Options

| Option | Description |
| :--- | :--- |
| **--database** | Specifies the database connection to use for accessing the `failed_jobs` table. |
| **--force** | Forces the command to run in a production environment without confirmation. |

---

## Practical Examples

1.  **Delete a single failed job with ID 5:**
    `php artisan queue:forget 5`

2.  **Delete a failed job with a specific UUID (often used in modern Laravel versions):**
    `php artisan queue:forget 81f8f3c7-31b6-407b-8c4d-b92209d02081`

# queue:failed

**Category**: Queue Management / Debugging

**Related**: queue:work, queue:retry, queue:forget

---

## Description

The `queue:failed` command is an Artisan utility in Laravel that displays a **list of all jobs that have failed** and been recorded in the application's failed job database table.

When a queued job fails after exhausting its maximum number of retries, Laravel records the job's payload, the connection, the queue, and the exception that caused the failure. This command is the primary way to quickly review which jobs have failed and obtain their **ID** and **UUID**, which are necessary for retrying (`queue:retry`) or forgetting (`queue:forget`) the job.

---

## Usage

### Command Structure

`php artisan queue:failed`

### Options

| Option | Description |
| :--- | :--- |
| **--id** | Displays the detailed information for a specific failed job ID. |
| **--detail** | Alias for the `--id` option (displays details for a specific failed job ID). |
| **--json** | Outputs the list of failed jobs as a raw JSON string. |

---

## Practical Examples

1.  **List all failed jobs in a summary table:**
    `php artisan queue:failed`

2.  **Display the details (payload, exception, etc.) for a specific failed job:**
    `php artisan queue:failed --id=5`

3.  **List all failed jobs as JSON output:**
    `php artisan queue:failed --json`

# queue:prune-failed

**Category**: Queue Management / Failure Handling Cleanup

**Related**: queue:failed, queue:flush

---

## Description

The `queue:prune-failed` command is an Artisan utility in Laravel used to **delete old records of failed jobs** from the `failed_jobs` database table.

While `queue:flush` deletes *all* failed jobs regardless of age, `queue:prune-failed` allows for the deletion of failed jobs that are **older than a specified time limit**. This is an effective way to maintain the size and efficiency of the `failed_jobs` table by automatically clearing out records that are no longer relevant for analysis or retry attempts.

This command is ideal for setting up as a scheduled task to run periodically (e.g., daily).

---

## Usage

### Command Structure

`php artisan queue:prune-failed`

### Options

| Option | Description |
| :--- | :--- |
| **--hours** | Prune failed jobs older than the given number of hours. If neither `--hours` nor `--days` is provided, the framework's default setting is used (usually 24 hours). |
| **--days** | Prune failed jobs older than the given number of days. |
| **--force** | Forces the command to run in a production environment without confirmation. |

---

## Practical Examples

1.  **Prune all failed jobs older than 24 hours (default setting):**
    `php artisan queue:prune-failed`

2.  **Prune failed jobs older than 60 days:**
    `php artisan queue:prune-failed --days=60`

3.  **Set up pruning in the Scheduler (Kernel.php) to run weekly:**
    `$schedule->command('queue:prune-failed', ['--days' => 7])->weekly();`

# queue:prune-batches

**Category**: Queue Management / Batches Cleanup

**Related**: queue:work, dispatch(new Job)->allOnQueue(...), BatchRepository

---

## Description

The `queue:prune-batches` command is an Artisan utility in Laravel used to **delete old records of finished job batches** from the database.

When Laravel processes job batches, it records the batch metadata (such as total jobs, pending jobs, and job names) in a dedicated database table (usually `job_batches`). Over time, this table can grow significantly. This command allows you to automatically clean up and prune completed batches older than a specified number of hours or days, helping to keep your database clean and efficient.

This command is typically set up to run daily via Laravel's Task Scheduling.

---

## Usage

### Command Structure

`php artisan queue:prune-batches`

### Options

| Option | Description |
| :--- | :--- |
| **--hours** | Prune batches older than the given number of hours. If neither `--hours` nor `--days` is provided, the framework's default setting is used (usually 24 hours). |
| **--days** | Prune batches older than the given number of days. |
| **--unfinished** | Additionally prune any batches that have not yet completed (still pending or running) that are older than the specified time. |
| **--force** | Forces the command to run in a production environment without confirmation. |

---

## Practical Examples

1.  **Prune all completed batches older than 24 hours (default setting):**
    `php artisan queue:prune-batches`

2.  **Prune completed batches older than 7 days:**
    `php artisan queue:prune-batches --days=7`

3.  **Prune completed batches older than 48 hours AND also prune unfinished batches older than 48 hours:**
    `php artisan queue:prune-batches --hours=48 --unfinished`

4.  **Set up pruning in the Scheduler (Kernel.php):**
    `$schedule->command('queue:prune-batches', ['--days' => 30])->daily();`

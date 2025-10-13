# model:prune

**Category**: Database Management / Model Cleanup

**Related**: queue:prune-batches, model:prunable

---

## Description

The `model:prune` command is an Artisan utility in Laravel used to **delete old records from database tables** that correspond to Prunable Eloquent models.

A model is considered "Prunable" if it uses the `Illuminate\Database\Eloquent\Prunable` trait and defines a `prunable()` method. This method specifies a query to select which records should be considered for deletion (e.g., records older than a specific date). This command is the execution mechanism for these cleanup queries.

This command is essential for maintaining database health, reducing table size, and improving query performance by automatically removing historical data that is no longer needed. It is typically set up to run daily via Laravel's Task Scheduling.

---

## Usage

### Command Structure

`php artisan model:prune`

### Options

| Option          | Description |
|:----------------| :--- |
| **--model**     | Specify a comma-separated list of model classes to prune (e.g., `--model="App\Models\AuditLog,App\Models\Notification"`). If omitted, all Prunable models will be pruned. |
| **--except**    | Specify a comma-separated list of model classes to exclude from pruning. |
| **--pretend**   | Runs the pruning query without executing any deletion; only shows a report of how many records *would* be deleted. |
| **--chunks**    | The number of records to retrieve and delete in each chunk (batch). |
| **--force**     | Forces the command to run in a production environment without confirmation. |

---

## Practical Examples

1.  **Prune all configured Prunable models:**
    `php artisan model:prune`

2.  **Prune only the 'AuditLog' model records:**
    `php artisan model:prune --model="App\Models\AuditLog"`

3.  **Simulate the pruning and report the number of records that would be deleted:**
    `php artisan model:prune --pretend`

4.  **Set up pruning in the Scheduler (Kernel.php) to run daily:**
    `$schedule->command('model:prune')->daily();`

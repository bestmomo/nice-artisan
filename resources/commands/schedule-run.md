# schedule:run

**Category**: Task Scheduling / Execution

**Related**: schedule:work, schedule:list, app/Console/Kernel.php

---

## Description

The `schedule:run` command is the single most important Artisan command for Laravel's task scheduler. Its purpose is to **evaluate all registered scheduled tasks** and execute any that are due to run at the time the command is executed.

This command is designed to be run **every minute** via a single **Cron job** configured on your server.

When executed, it performs the following steps:
1.  Loads all tasks defined in `app/Console/Kernel.php`.
2.  Checks the current time against the specified schedules (e.g., `hourly`, `daily`, `cron('* * * * *')`).
3.  Ensures mutex locks are respected (meaning tasks marked with `->withoutOverlapping()` or `->once()` run only when intended).
4.  Dispatches any due tasks for execution.

---

## Usage

### Command Structure

`php artisan schedule:run`

### Cron Job Configuration

The required entry in your server's Cron job or process supervisor (like Supervisor) looks like this:

`cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1`

### Options

| Option | Description |
| :--- | :--- |
| **--no-output** | Suppresses the output of the scheduled commands. |
| **--only-due** | Instructs the command to only run tasks that are due, skipping checks for tasks that might be ready to run if not due. |

---

## Practical Examples

1.  **Execute the scheduler to run any tasks that are currently due (primary usage):**
    `php artisan schedule:run`

2.  **Run the scheduler without displaying any output in the console:**
    `php artisan schedule:run --no-output`

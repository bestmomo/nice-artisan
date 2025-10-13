# schedule:clear-cache

**Category**: Task Scheduling / Cache Management

**Related**: schedule:run, schedule:list, cache:clear

---

## Description

The `schedule:clear-cache` command is an Artisan utility in Laravel used to **clear the cache locks** used by the scheduler to manage background execution.

Laravel uses a cache-based mutex (mutual exclusion lock) to ensure that a scheduled task, particularly one running on multiple servers, executes only once per interval. If these cache locks become stale or corrupted, they can prevent scheduled tasks from running. This command provides a way to manually clear those locks, allowing the scheduler to resume normal operation.

---

## Usage

### Command Structure

`php artisan schedule:clear-cache`

### Options

This command is typically run without any options.

| Option | Description |
| :--- | :--- |
| **--help** | Displays the help screen for the command. |

---

## Practical Example

**Clear the scheduled task cache lock (used for troubleshooting skipped tasks):**
    `php artisan schedule:clear-cache`

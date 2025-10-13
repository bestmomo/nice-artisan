# schedule:list

**Category**: Task Scheduling / Introspection

**Related**: schedule:run, schedule:work, app/Console/Kernel.php

---

## Description

The `schedule:list` command is an Artisan utility in Laravel used to **display a formatted table of all scheduled tasks** that are registered within your application's `app/Console/Kernel.php` file.

This is the primary way to verify what your scheduler is intended to execute. The output includes crucial details such as the command string, the schedule frequency (e.g., `* * * * *` or `hourly`), the next due time, and the description (if provided).

This command is invaluable for auditing, debugging, and ensuring that all intended background processes are correctly configured.

---

## Usage

### Command Structure

`php artisan schedule:list`

### Output

The command produces a table typically including the following columns:

| Column | Description |
| :--- | :--- |
| **Name** | The unique identifier or name of the scheduled event (if manually assigned). |
| **Schedule** | The human-readable frequency (e.g., `hourly`, `daily at 10:00`). |
| **Command** | The raw command string that will be executed. |
| **Description** | A user-friendly description of the task (if provided using `->description()`). |
| **Next Due** | The calculated next date and time the task is scheduled to run. |

### Options

| Option | Description |
| :--- | :--- |
| **--json** | Outputs the complete list of scheduled tasks as a raw JSON string. |

---

## Practical Example

**List all scheduled tasks and their details:**
`php artisan schedule:list`

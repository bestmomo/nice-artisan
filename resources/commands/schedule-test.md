# schedule:test

**Category**: Task Scheduling / Testing

**Related**: schedule:list, schedule:run, app/Console/Kernel.php

---

## Description

The `schedule:test` command is an Artisan utility in Laravel used to **simulate the execution of the scheduler** and report which tasks *would* run if the command were executed at the current moment.

This command is invaluable during development and testing because it executes the logic that determines if a task is due, including all frequency checks (e.g., `hourly`, `->when()`, `->dailyAt()`) and mutex checks (`->withoutOverlapping()`). It is primarily used to:

1.  Verify that your scheduled commands are correctly registered and their frequencies are correct.
2.  Determine which tasks will run without actually triggering the execution of those tasks.

---

## Usage

### Command Structure

`php artisan schedule:test`

### Output

The output lists every scheduled task and indicates whether it is **"Due"** (meaning it would run) or **"Skipped"** (meaning its scheduled time has not arrived or a mutex lock prevented it).

### Options

This command is typically run without any options.

| Option | Description |
| :--- | :--- |
| **--help** | Displays the help screen for the command. |

---

## Practical Examples

**Check which tasks are currently due to run based on the configuration:**

`php artisan schedule:test`

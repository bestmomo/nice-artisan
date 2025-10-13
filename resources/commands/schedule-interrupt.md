# schedule:interrupt

**Category**: Task Scheduling / Interruption

**Related**: schedule:run, schedule:work, schedule:list

---

## Description

The `schedule:interrupt` command is an Artisan utility in Laravel used to **gracefully stop** a scheduled task that is currently running as a queue job.

When a scheduled job is configured to run on the queue using methods like `->onQueue()`, Laravel runs the task as a dedicated job. If this task needs to be stopped early (e.g., it is stuck, taking too long, or consuming excessive resources), this command can be used.

It works by sending an interruption signal (like a `SIGTERM`) to the underlying queue worker process responsible for the specific scheduled job, instructing it to terminate processing gracefully.

**Note:** The effectiveness of this command depends on the operating system and the process supervisor managing the queue workers. It is primarily useful when using the `schedule:work` command or running scheduled tasks on a queue.

---

## Usage

### Command Structure

`php artisan schedule:interrupt <task-id>`

### Arguments

| Argument | Description |
| :--- | :--- |
| **task-id** | The unique identifier of the running scheduled task instance. This ID is typically managed internally by the scheduler. |

### Options

| Option | Description |
| :--- | :--- |
| **--force** | Forces the command to run in a production environment without confirmation. |

---

## Practical Example

**Interrupt a specific running scheduled task (e.g., task with ID 123):**
`php artisan schedule:interrupt 123`

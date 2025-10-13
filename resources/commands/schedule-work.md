# schedule:work

**Category**: Task Scheduling / Worker

**Related**: schedule:run, queue:work, Supervisor

---

## Description

The `schedule:work` command is an Artisan utility in Laravel (introduced in Laravel 9) that runs as a **dedicated daemon process** to continuously process scheduled tasks.

Unlike the traditional method where the server's Cron runs `schedule:run` every minute, `schedule:work` keeps the scheduler logic running in memory, checking for due tasks every second. When a task is due, it immediately executes the command or dispatches the job.

This method avoids the sub-second delay and overhead associated with executing a new PHP process every minute via Cron, providing a more responsive and resource-efficient scheduling solution. It is often managed by a process supervisor like **Supervisor** or **Systemd**.

---

## Usage

### Command Structure

`php artisan schedule:work`

### Comparison to `schedule:run`

| Command | Execution Method | Overhead | Use Case |
| :--- | :--- | :--- | :--- |
| **schedule:run** | Executed once per minute by the server's Cron. | High (re-boots the application every minute). | Traditional, simple setup. |
| **schedule:work** | Runs continuously as a daemon, checking every second. | Low (application stays booted in memory). | High-performance, low-latency scheduling. |

### Options

| Option | Description |
| :--- | :--- |
| **--no-output** | Suppresses the output of the scheduled commands. |
| **--force** | Forces the command to run in a production environment without confirmation. |

---

## Practical Examples

1.  **Start the continuous schedule worker (designed to be run by a process supervisor):**
    `php artisan schedule:work`

2.  **Start the worker and suppress all command output:**
    `php artisan schedule:work --no-output`

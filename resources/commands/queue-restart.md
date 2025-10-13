# queue:restart

**Category**: Queue Management / Worker Control

**Related**: queue:work, queue:listen, cache

---

## Description

The `queue:restart` command is an Artisan utility in Laravel that signals all currently running **queue workers** (`queue:work` processes) to **gracefully restart**.

It does this by placing a specific item (often a timestamp) into the application's cache. When a queue worker finishes processing its current job and checks for the next job, it checks the cache for this restart signal. If the signal is present, the worker exits gracefully, allowing a process supervisor (like **Supervisor** or **Systemd**) to immediately spin up a fresh, restarted worker process.

This command is crucial during deployment to load fresh application code into the queue workers without losing or dropping any jobs that are currently being processed.

---

## Usage

### Command Structure

`php artisan queue:restart`

### Important Notes

* This command relies on the **cache driver** being properly configured and accessible by the workers.
* The workers **do not stop immediately**; they finish their current job first, ensuring a "graceful" restart.
* You must be running your queue workers in **daemon mode** (`queue:work`) for this command to be effective with process supervisors.

### Options

| Option | Description |
| :--- | :--- |
| **--connection** | Specifies a specific queue connection to target for the restart signal. |

---

## Practical Examples

1.  **Signal all running workers across all connections to restart:**
    `php artisan queue:restart`

2.  **Signal only workers attached to the 'redis' connection to restart:**
    `php artisan queue:restart --connection=redis`

# queue:work

**Category**: Queue Management / Worker

**Related**: queue:restart, queue:work --daemon, Supervisor

---

## Description

The `queue:work` command is the primary Artisan utility in Laravel used to **start a queue worker** that processes jobs pushed onto your queues.

The worker continuously polls the queue (based on the configured driver and options) and executes the `handle()` method of any available job. This command is designed to be run **indefinitely** and is typically managed by a process supervisor (like **Supervisor** or **Systemd**) to ensure it keeps running and restarts if it fails.

This command replaced the less efficient `queue:listen` command by keeping the application booted in memory (daemon mode by default), significantly improving performance by eliminating the overhead of re-bootstrapping the framework for every single job.

---

## Usage

### Command Structure

`php artisan queue:work [connection]`

### Arguments

| Argument | Description |
| :--- | :--- |
| **connection** | The name of the queue connection to process jobs from (e.g., `redis`, `database`). If omitted, the default connection is used. |

### Options

| Option | Description |
| :--- | :--- |
| **--queue** | A comma-separated list of queues to process. The order determines the processing priority (e.g., `--queue=high,default`). |
| **--once** | Process only **one** job from the queue and then exit. Useful for local development or testing. |
| **--delay** | The number of seconds to wait before releasing a job that encounters an exception back onto the queue. |
| **--timeout** | The number of seconds a child process should be allowed to run before being killed by the worker. |
| **--tries** | The maximum number of times a job should be attempted before being moved to the failed jobs table. |
| **--sleep** | The number of seconds to sleep when no jobs are available (only applies to non-daemon mode). |
| **--daemon** | Forces the worker to run in the deprecated daemon mode (not needed in modern Laravel as it is the default behavior). |
| **--force** | Forces the worker to run even when the application is in maintenance mode. |

---

## Practical Examples

1.  **Start a worker processing jobs from the default connection and default queue:**
    `php artisan queue:work`

2.  **Start a worker processing jobs from the 'redis' connection, prioritizing 'high' then 'default' queues:**
    `php artisan queue:work redis --queue=high,default`

3.  **Process a single job and exit (good for local testing):**
    `php artisan queue:work --once`

4.  **Start a worker that will only attempt a job 3 times before failing it:**
    `php artisan queue:work --tries=3`

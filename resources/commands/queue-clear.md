# queue:clear

**Category**: Queue Management

**Related**: queue:work, queue:listen, queue:failed

---

## Description

The `queue:clear` command is an Artisan utility in Laravel that is used to **delete all pending jobs** from a specified queue, or the default queue if none is specified.

This command is non-destructive to the database tables themselves (like the `jobs` or `failed_jobs` tables); rather, it removes the job entries that are currently waiting to be processed by a queue worker. This is useful for development or debugging when you need to flush out a backlog of jobs without restarting your application.

**Note:** This command relies on the specific queue driver's capabilities. For example, it works effectively with the **database** and **Redis** drivers but might not be available or function identically on external services like SQS or Beanstalkd.

---

## Usage

### Command Structure

`php artisan queue:clear` [connection]

### Arguments

| Argument | Description |
| :--- | :--- |
| **connection** | The name of the queue connection whose jobs should be cleared (e.g., `redis`, `database`). Optional. |

### Options

| Option | Description |
| :--- | :--- |
| **--queue** | Specifies the name of the specific queue to clear (e.g., `emails`, `high`). If not provided, the default queue for the connection is cleared. |

---

## Practical Examples

1.  **Clear all pending jobs from the default queue connection:**
    `php artisan queue:clear`

2.  **Clear jobs from a specific connection (e.g., the Redis connection):**
    `php artisan queue:clear redis`

3.  **Clear jobs from a specific queue named 'emails' on the default connection:**
    `php artisan queue:clear --queue=emails`

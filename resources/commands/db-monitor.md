# db:monitor

**Category**: Database & Monitoring

**Related**: db:show, Schedule, Notifications

---

## Description

The `db:monitor` command is a specialized utility used to **monitor the number of open connections** to one or more database connections. Its primary purpose is to help prevent **connection pool exhaustion** by dispatching an event when the number of connections exceeds a predefined threshold.

This command is typically set up as a **scheduled task** to run periodically in your application, acting as a "database watchdog" to proactively alert you of potential scaling issues.

---

## When to Use This Command

- **Scalability Check:** To monitor high-traffic applications where you risk exceeding the maximum allowed connections on your database server.
- **Proactive Alerting:** To dispatch an event or notification (via a listener) when connection usage nears a critical limit, allowing you to react before users encounter errors.
- **Debugging:** To track how many concurrent connections different parts of your application (like a queue worker or cron job) might be opening.

---

## Basic Usage

The command requires no arguments to monitor the **default database connection**.

`php artisan db:monitor`

---

## Available Options

| Option | Shortcut | Description |
| :--- | :--- | :--- |
| **databases** | | A comma-separated list of database connection names to monitor (e.g., `mysql,pgsql`). |
| **max** | | The **maximum** number of open connections that can be reached before a `DatabaseBusy` event is dispatched. |

---

## Practical Examples

1.  **Monitor the default connection with a safety limit of 50:**
    ```bash
    php artisan db:monitor --max=50
    ```

2.  **Monitor both `mysql` and `secondary` connections with a shared limit of 100:**
    ```bash
    php artisan db:monitor --databases=mysql,secondary --max=100
    ```

### Scheduling the Monitor

The command is most useful when scheduled in `app/Console/Kernel.php`:

```php
// In app/Console/Kernel.php -> schedule(Schedule $schedule)
protected function schedule(Schedule $schedule): void
{
    // Check the main database connections every minute
    $schedule->command('db:monitor --max=75')->everyMinute();
}
```
## Related Concepts

**Event Dispatching**: When the `--max` threshold is exceeded, Laravel dispatches the `Illuminate\Database\Events\DatabaseBusy` event, allowing you to create listeners to handle alerts (e.g., send a Slack message).

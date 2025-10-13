# queue:listen (Obsolete)

**Category**: Queue Management / Worker

**Related**: queue:work, queue:restart

---

## Description

The `queue:listen` command was an Artisan utility historically used to **continuously listen for new jobs** on a specified queue connection.

When a job arrived, the command would bootstrap the application, process the job, and then **shut down and bootstrap the application again** to wait for the next job. This continuous re-bootstrapping process was resource-intensive and slow.

**⚠️ Current Status:** The `queue:listen` command is **obsolete** (deprecated) since Laravel 5.3. It has been replaced by the more efficient `php artisan queue:work` command when run with the `--daemon` flag (or simply `php artisan queue:work` in modern Laravel), which keeps the application running in memory, avoiding the boot overhead.

---

## Usage

### Command Structure

`php artisan queue:listen` [connection]

### Arguments

| Argument | Description |
| :--- | :--- |
| **connection** | The name of the queue connection to listen on (e.g., `redis`, `database`). Optional. |

### Options

| Option | Description |
| :--- | :--- |
| **--queue** | A comma-separated list of queues to listen to. The order defines the processing priority. |
| **--delay** | The number of seconds to wait before releasing a job that encounters an exception back onto the queue. |
| **--timeout** | The number of seconds a child process should be allowed to run before being killed. |
| **--tries** | The maximum number of times a job should be attempted before being marked as failed. |
| **--sleep** | The number of seconds to sleep when no jobs are available. |

---

## Modern Replacement Command

You should use `queue:work` instead, which runs as a daemon for better performance:

**Start a high-performance daemon worker (Modern Laravel):**
`php artisan queue:work`

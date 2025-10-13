# queue:retry

**Category**: Queue Management / Failure Handling

**Related**: queue:failed, queue:forget, queue:work

---

## Description

The `queue:retry` command is an Artisan utility in Laravel used to **re-queue one or more specific failed jobs** for another attempt at processing.

This command is typically used after running `php artisan queue:failed` to identify the job ID(s). Once you have reviewed the error and potentially deployed a fix to your application code, you can use `queue:retry` to move the failed job(s) from the `failed_jobs` table back onto the active queue for your worker(s) to process.

---

## Usage

### Command Structure

`php artisan queue:retry <id> [id]...`

### Arguments

| Argument | Description |
| :--- | :--- |
| **id** | One or more **unique IDs or UUIDs** of the failed job(s) to be retried. These IDs are obtained from the `queue:failed` command. |

### Options

| Option | Description |
| :--- | :--- |
| **--queue** | Specify a different queue name to place the job(s) onto for the retry attempt. If omitted, the jobs are placed back on their original queue. |
| **--connection** | Specifies the queue connection to use for placing the job(s) back on the queue. |
| **--force** | Forces the command to run in a production environment without confirmation. |

---

## Practical Examples

1.  **Retry a single failed job with ID 10:**
    `php artisan queue:retry 10`

2.  **Retry multiple failed jobs by their IDs:**
    `php artisan queue:retry 15 16 17`

3.  **Retry a job and place it on a different queue named 'processing':**
    `php artisan queue:retry 20 --queue=processing`

4.  **Retry all failed jobs that are currently logged:**
    `php artisan queue:retry all`

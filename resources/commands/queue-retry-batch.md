# queue:retry-batch

**Category**: Queue Management / Batches Failure Handling

**Related**: queue:retry, queue:failed, queue:prune-batches

---

## Description

The `queue:retry-batch` command is an Artisan utility in Laravel used to **re-queue all failed jobs belonging to a specific batch**.

When a batched job fails, the entire batch metadata is marked as failed, but individual jobs within the batch that failed are also logged in the `failed_jobs` table. This command provides a simple way to retry every job in a specified batch without having to identify and list all the individual failed job IDs.

This is useful when you have fixed a bug that caused many jobs in a single batch to fail, allowing you to easily resume the batch processing.

---

## Usage

### Command Structure

`php artisan queue:retry-batch <batch-id>`

### Arguments

| Argument | Description |
| :--- | :--- |
| **batch-id** | The **UUID** of the batch to retry. This UUID can be found in the `job_batches` database table. |

### Options

| Option | Description |
| :--- | :--- |
| **--force** | Forces the command to run in a production environment without confirmation. |

---

## Practical Examples

1.  **Retry all failed jobs associated with a specific batch UUID:**
    `php artisan queue:retry-batch a2c4d7e9-81f8-4b2a-8c4d-a92d09d02081`

2.  **Retry a batch on a production server (use with caution):**
    `php artisan queue:retry-batch b1f4e7a8-32a1-4c1c-9b5e-c19a08c02092 --force`

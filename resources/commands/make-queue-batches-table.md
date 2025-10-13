# make:queue-batches-table

**Category**: Database & Queues

**Related**: make:job, migrate, queue:work, dispatch(new Batch(...))

---

## Description

The `make:queue-batches-table` command generates a database migration necessary to create the **`job_batches`** table. This table is used by Laravel's **Job Batching** feature, which allows you to execute a group of queued jobs together and then perform some action (like sending a notification) when the entire batch is complete.

This table tracks the state, progress, and completion of entire job batches, which is critical for coordinating large, dependent groups of asynchronous tasks.

---

## When to Use This Command

- When you need to process a large number of tasks as a single logical unit.
- When you require a mechanism to track the overall progress of multiple queued jobs.
- When you must perform a "finish" action only after all jobs in a group have successfully completed.
- As an initial setup step for using the `Bus` facade's `batch()` method.

---

## Basic Usage

The command generates the migration file; it does not run it.

`php artisan make:queue-batches-table`

---

## Available Options

*Note: This command generates a fixed schema and typically does not require any options.*

| Option | Shortcut | Description |
| :--- | :--- | :--- |
| **--force** | | Force the operation to run when in production. |

---

## Practical Examples

Generate the batch table migration:
`php artisan make:queue-batches-table`

---

## Generated Migration File

The command creates a file similar to `xxxx_xx_xx_xxxxxx_create_job_batches_table.php` in your `database/migrations` directory, containing the required schema:

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('job_batches', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('name');
            $table->integer('total_jobs');
            $table->integer('pending_jobs');
            $table->integer('failed_jobs');
            $table->text('failed_job_ids');
            $table->text('options')->nullable();
            $table->integer('cancelled_at')->nullable();
            $table->integer('created_at');
            $table->integer('finished_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_batches');
    }
};
```
### Next Steps

After running this command, you must execute the migration to create the table:

`php artisan migrate`

## Related Commands

* **make:job** - Used to create the individual jobs that will be processed within a batch.
* **migrate** - Runs the generated migration.
* **queue:work** - The worker process that executes the jobs and updates the batch status.

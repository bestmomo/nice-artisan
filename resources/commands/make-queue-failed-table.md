# make:queue-failed-table (Laravel 12+)

**Category**: Database & Queues

**Related**: queue:failed-table, queue:retry, queue:forget

---

## Description

The `make:queue-failed-table` command generates a database migration to create the **`failed_jobs`** table. This table is a fundamental component of Laravel's Queue system, serving as the central repository for storing information about any queued job that fails to process after all available retries have been exhausted.

Storing failed jobs allows developers to inspect the job payload, the connection, the queue, and the exception that caused the failure, facilitating debugging and manual retry attempts.

---

## When to Use This Command

- When setting up Laravel's queue system for the first time.
- When you require a persistent, searchable record of all job failures.
- To enable the use of the `queue:retry` and `queue:forget` Artisan commands for managing failed jobs.

---

## Basic Usage

The command generates the migration file; it does not run it.

`php artisan make:queue-failed-table`

---

## Available Options

*Note: This command generates a fixed schema and typically does not require any options.*

| Option | Shortcut | Description |
| :--- | :--- | :--- |
| **--force** | | Force the operation to run when in production. |

---

## Practical Examples

Generate the failed jobs table migration:
`php artisan make:queue-failed-table`

---

## Generated Migration File

The command creates a file similar to `xxxx_xx_xx_xxxxxx_create_failed_jobs_table.php` in your `database/migrations` directory, containing the required schema:

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
        Schema::create('failed_jobs', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique(); // Unique identifier for retrying/forgetting
            $table->text('connection');
            $table->text('queue');
            $table->longText('payload'); // The serialized job data
            $table->longText('exception'); // The full exception trace
            $table->timestamp('failed_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('failed_jobs');
    }
};
```
### Next Steps

After running this command, you must execute the migration to create the table:

`php artisan migrate`

## Related Commands

* **queue:work** - The worker that attempts to process jobs and sends failures to this table.
* **queue:retry** - Retries a specific failed job using its UUID or all failed jobs.
* **queue:forget** - Deletes a specific failed job record from this table.
* **migrate** - Runs the generated migration.

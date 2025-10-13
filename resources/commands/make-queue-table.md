# make:queue-table

**Category**: Database & Queues

**Related**: make:job, migrate, queue:work, queue:table (legacy)

---

## Description

The `make:queue-table` command generates a database migration to create the **`jobs`** table. This table is the foundational requirement for using the **database driver** as your queue backend in Laravel. The `jobs` table is where all asynchronous tasks (jobs) are stored temporarily after they are dispatched and before they are processed by a queue worker (`php artisan queue:work`).

This table is essential if you choose to use the database as your primary mechanism for persisting and managing queued tasks.

---

## When to Use This Command

- When setting up Laravel's queue system and selecting the **`database`** driver in your `config/queue.php` file.
- When you need a reliable, visible queue backend that doesn't require an external service like Redis or Amazon SQS (though external services are typically faster).
- As an initial setup step before dispatching any queueable job.

---

## Basic Usage

The command generates the migration file; it does not run it.

`php artisan make:queue-table`

---

## Available Options

*Note: This command generates a fixed schema and typically does not require any options.*

| Option | Shortcut | Description |
| :--- | :--- | :--- |
| **--force** | | Force the operation to run when in production. |

---

## Practical Examples

Generate the queue table migration:
`php artisan make:queue-table`

---

## Generated Migration File

The command creates a file similar to `xxxx_xx_xx_xxxxxx_create_jobs_table.php` in your `database/migrations` directory, containing the required schema:

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
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('queue')->index(); // The name of the queue the job belongs to
            $table->longText('payload'); // The serialized job data
            $table->unsignedTinyInteger('attempts'); // Number of times the job has been attempted
            $table->unsignedInteger('reserved_at')->nullable(); // Timestamp when the job was reserved by a worker
            $table->unsignedInteger('available_at'); // Timestamp when the job is available for processing
            $table->unsignedInteger('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
```
### Next Steps

After running this command, you must execute the migration to create the table:

`php artisan migrate`

## Related Commands
* **make:job** - Used to create the job classes that will be stored in this table.
* **migrate** - Runs the generated migration.
* **queue:work** - Starts the worker process that reads jobs from this table and executes them.
* **make:queue-failed-table** - Creates the table for storing jobs that permanently fail.

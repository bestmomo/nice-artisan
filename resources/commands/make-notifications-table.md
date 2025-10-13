# make:notifications-table

**Category**: Database & Notifications

**Related**: make:notification, migrate, notifications:table (legacy)

---

## Description

The `make:notifications-table` command generates a database migration to create the standard table required to store **database notifications**. This table acts as a central repository for "in-app" notifications, allowing users to view, read, and manage alerts within the application's user interface.

This table is essential when using the `'database'` channel within your `via()` method on a Mailable class.

---

## When to Use This Command

- When you plan to use the **`database`** channel for any of your notifications.
- To enable users to view a list of their unread and read notifications directly within the application's interface (like a notification bell).
- As an initial setup step for Laravel's built-in notification system.

---

## Basic Usage

The command generates the migration file; it does not run it.

`php artisan make:notifications-table`

---

## Available Options

*Note: This command typically generates a standard migration file and rarely requires options.*

| Option | Shortcut | Description |
| :--- | :--- | :--- |
| **--force** | | Force the operation to run when in production. |

---

## Practical Examples

Generate the standard notification table migration:
`php artisan make:notifications-table`

---

## Generated Migration File

The command creates a file similar to `xxxx_xx_xx_xxxxxx_create_notifications_table.php` in your `database/migrations` directory, containing the schema necessary to store notification data:

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
        Schema::create('notifications', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('type');
            $table->morphs('notifiable'); // Stores the model name and ID of the recipient
            $table->text('data'); // Stores the notification content (usually JSON)
            $table->timestamp('read_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
```
### Next Steps

After running this command, you must execute the migration:

`php artisan migrate`

## Related Commands

* **make:notification** - Used to create the notification class that will use the 'database' channel.
* **migrate** - Runs the generated migration to create the table in the database.
* **notifications:table** - Legacy command in older Laravel versions (pre-Laravel 11) that performed the same action.

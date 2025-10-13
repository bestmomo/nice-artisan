# make:session-table

**Category**: Database & HTTP

**Related**: make:middleware, config/session.php, migrate

---

## Description

The `make:session-table` command generates a database migration to create the **`sessions`** table. This table is required if you configure your Laravel application to use the **`database`** driver for storing user session data (as defined in `config/session.php`).

Storing sessions in the database is a reliable alternative to file-based or cookie-based sessions, especially in multi-server or load-balanced environments where all application instances need access to the same session data.

---

## When to Use This Command

- When you set your session driver to `database` in your `config/session.php` file.
- When running your application across multiple web servers and needing a centralized session store that all servers can access.
- When you require a persistent session store that is easily introspectable and managed alongside your application's other data.

---

## Basic Usage

The command generates the migration file; it does not run it.

`php artisan make:session-table`

---

## Available Options

*Note: This command generates a fixed schema and typically does not require any options.*

| Option | Shortcut | Description |
| :--- | :--- | :--- |
| **--force** | | Force the operation to run when in production. |

---

## Practical Examples

Generate the session table migration:
`php artisan make:session-table`

---

## Generated Migration File

The command creates a file similar to `xxxx_xx_xx_xxxxxx_create_session_table.php` in your `database/migrations` directory, containing the required schema:

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
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index(); // ID of the authenticated user
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload'); // Serialized session data
            $table->integer('last_activity')->index(); // Timestamp of last activity
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessions');
    }
};
```
### Next Steps

After running this command, you must execute the migration to create the table:

`php artisan migrate`
## Related Commands

* **migrate** - Runs the generated migration.
* **make:middleware** - Sessions are managed by the `StartSession` middleware, which is run on every HTTP request.
* **session:table** - _Legacy command in older Laravel versions_ (pre-Laravel 11) that performed the same action.

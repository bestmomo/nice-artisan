# make:command

**Category**: Code Generation & Console

**Related**: list, schedule:run, make:job

---

## Description

The `make:command` command creates a new **Artisan Command Class** in your `app/Console/Commands` directory. These classes allow you to define custom terminal commands that can be executed via the `php artisan` entry point.

Custom commands are the core way to run background tasks, maintenance scripts, data transformations, or any custom console-based logic within your Laravel application.

---

## When to Use This Command

- When creating a recurring maintenance task (e.g., daily cleanup, report generation).
- When building utility tools for developers or administrators (e.g., custom user creation flow).
- When defining long-running background processes that should be executed via the console (often scheduled).
- To define a command that will be added to Laravel's task scheduler.

---

## Basic Usage

The command requires the desired name of the Command Class. Laravel placera automatiquement ce fichier dans `app/Console/Commands`.

`php artisan make:command SendWeeklyReports`

---

## Available Options

| Option | Shortcut | Description |
| :--- | :--- | :--- |
| **--command** | | The terminal signature of the command. Defaults to `app:command-name`. |
| **--force** | | Create the class even if the command already exists. |

---

## Practical Examples

Create a command with the default signature (`app:send-weekly-reports`):
`php artisan make:command SendWeeklyReports`

Create a command with a custom signature (`reports:send-weekly`):
`php artisan make:command SendWeeklyReports --command=reports:send-weekly`

---

## Generated Command File

The command generates a file, for example `app/Console/Commands/SendWeeklyReports.php`, with the following structure:

```php
<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SendWeeklyReports extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:name'; // <-- To be updated with --command option

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Votre logique de commande va ici
    }
}
```
### Execution

The command can be executed from your terminal using the signature defined in the $signature property:

`php artisan app:name argument --option`

Or in Nice Artisan!

## Related Commands

* **list** - Lists all available Artisan commands (including your custom commands).
* **schedule:run** - Runs all scheduled commands that are due.
* **make:job** - Generates a job class, often used to offload heavy tasks started from a command.
* **make:event** - Used if the command needs to dispatch events.


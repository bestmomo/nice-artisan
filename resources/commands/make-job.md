# make:job

**Category**: Code Generation & Queues

**Related**: queue:work, make:command, make:mail, make:notification

---

## Description

The `make:job` command creates a new **Job Class** in your `app/Jobs` directory. Jobs encapsulate any task that should be executed *asynchronously* (in the background) or *synchronously* (immediately) outside of the main HTTP request/response cycle.

Jobs are the primary mechanism for offloading heavy, slow, or time-consuming tasks to Laravel's **Queue** system, greatly improving the performance and responsiveness of your web application.

---

## When to Use This Command

- When performing long-running processes like sending bulk emails, optimizing images, or processing large file uploads.
- When executing tasks that might fail temporarily (e.g., calling an external API) and need to be retried automatically.
- To decouple the execution of a task from the user's immediate request, returning a response quickly.

---

## Basic Usage

The command requires the name you wish to give your Job Class.

`php artisan make:job ProcessPodcast`

---

## Available Options

| Option | Shortcut | Description |
| :--- | :--- | :--- |
| **--sync** | | Indicates that the job should be synchronous, implementing the `ShouldQueue` interface. |
| **--force** | | Create the class even if the job already exists. |

---

## Practical Examples

Create a standard queueable job:
`php artisan make:job SendWelcomeEmail`

Create a job intended to be run synchronously (for specific architectural needs):
`php artisan make:job CleanCache --sync`

---

## Generated Job File

The command generates a file, for example `app/Jobs/ProcessPodcast.php`, with the following base structure. Note the `ShouldQueue` interface, which is included by default unless `--sync` is used.

```php
<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessPodcast implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        // Les propriétés passées ici sont injectées dans la méthode handle()
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Logic for the task goes here
    }
}
```
### Dispatching the Job

The job is typically added to the queue via the `dispatch()` helper or method:
```php
// Dispatching the job
ProcessPodcast::dispatch($podcast);
```
## Related Commands

* **queue:work** - Starts the queue listener process to process the dispatched jobs.
* **queue:table** - Creates the migration for the database queue backend.
* **make:command** - Used to create console commands, which often dispatch jobs.
* **schedule:run** - Runs scheduled tasks, which can include dispatching jobs.

# make:job-middleware

**Category**: Code Generation & Queues

**Related**: make:job, queue:work, middleware

---

## Description

The `make:job-middleware` command creates a new **Job Middleware Class** in your `app/Http/Middleware` directory (ou dans `app/Jobs/Middleware` si vous utilisez une ancienne convention, mais le standard est `app/Http/Middleware`). Job middleware allows you to define custom logic that runs *before* or *after* a queued job is processed.

This mechanism is highly effective for tasks like rate limiting job execution, logging, wrapping database transactions, or performing final checks before a job's `handle()` method executes.

---

## When to Use This Command

- When you need to implement **rate limiting** for jobs that interact with external APIs (e.g., using Redis to track calls).
- To wrap the job's execution in a **database transaction** to ensure atomicity.
- When performing pre-processing or post-processing actions, such as releasing a lock or updating a status flag.
- To centralize and reuse queuing concerns that apply to multiple job classes.

---

## Basic Usage

The command requires the name you wish to give your Middleware Class.

`php artisan make:job-middleware RateLimitMiddleware`

---

## Available Options

| Option | Shortcut | Description |
| :--- | :--- | :--- |
| **--force** | | Create the class even if the middleware already exists. |

---

## Practical Examples

Create a middleware to manage job concurrency:
`php artisan make:job-middleware ConcurrencyLimiter`

Create a middleware to ensure database integrity:
`php artisan make:job-middleware TransactionalJobWrapper`

---

## Generated Middleware File

The command generates a file, for example `app/Http/Middleware/RateLimitMiddleware.php`, with the following base structure:

```php
<?php

namespace App\Http\Middleware;

class RateLimitMiddleware
{
    /**
     * Process the job.
     */
    public function handle(object $job, callable $next): void
    {
        // LOGIQUE AVANT L'EXÉCUTION DU JOB
        
        // Exécute le job
        $next($job);

        // LOGIQUE APRÈS L'EXÉCUTION DU JOB
    }
}
```
### Usage

The middleware is attached to a job class using the `middleware()` method within the job's `__construct()` or as a property:
```php
// In a Job Class (e.g., SendApiRequest.php)

use App\Http\Middleware\RateLimitMiddleware;

class SendApiRequest implements ShouldQueue
{
    // ...
    public function middleware(): array
    {
        return [new RateLimitMiddleware];
    }
    // ...
}
```
## Related Commands

* **make:job** - The job class that the middleware will wrap.
* **queue:work** - The worker process that executes the middleware and the job.
* **middleware** - General term for HTTP or Job processing wrappers in Laravel.

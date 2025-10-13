# make:middleware

**Category**: Code Generation & HTTP

**Related**: make:controller, route:list, middleware

---

## Description

The `make:middleware` command creates a new **HTTP Middleware Class** in your `app/Http/Middleware` directory. Middleware provides a convenient mechanism for filtering HTTP requests entering your application or performing actions *after* a response is generated.

Middleware forms the core of request manipulation in Laravel, handling tasks like authentication, session management, CORS headers, and logging before the request reaches your controller.

---

## When to Use This Command

- When you need to implement **global HTTP security checks** (e.g., verifying CSRF tokens).
- When defining **route-specific authorization** (e.g., ensuring a user is an administrator).
- To add **logging, debugging, or rate-limiting logic** to incoming requests.
- To perform **pre-processing** on the request (e.g., trimming input strings) or **post-processing** on the response.

---

## Basic Usage

The command requires the name you wish to give your Middleware Class.

`php artisan make:middleware EnsureTokenIsValid`

---

## Available Options

| Option | Shortcut | Description |
| :--- | :--- | :--- |
| **--force** | | Create the class even if the middleware already exists. |

---

## Practical Examples

Create a middleware to check if a user is subscribed:
`php artisan make:middleware CheckSubscriptionStatus`

Create a middleware to handle a specific API version:
`php artisan make:middleware ApiVersion1`

---

## Generated Middleware File

The command generates a file, for example `app/Http/Middleware/EnsureTokenIsValid.php`, with the following base structure:

```php
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureTokenIsValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->input('token') !== 'my-secret-token') {
            return redirect('/home');
        }

        return $next($request);
    }
}
```
### Registration and Usage

If you want a middleware to run during every HTTP request to your application, you may append it to the global middleware stack in your application's `bootstrap/app.php` file:
```php
use App\Http\Middleware\EnsureTokenIsValid;

->withMiddleware(function (Middleware $middleware): void {
     $middleware->append(EnsureTokenIsValid::class);
})
```
If you would like to manage Laravel's global middleware stack manually, you may provide Laravel's default stack of global middleware to the `use` method. Then, you may adjust the default middleware stack as necessary:
```php
->withMiddleware(function (Middleware $middleware): void {
    $middleware->use([
        \Illuminate\Foundation\Http\Middleware\InvokeDeferredCallbacks::class,
        // \Illuminate\Http\Middleware\TrustHosts::class,
        \Illuminate\Http\Middleware\TrustProxies::class,
        \Illuminate\Http\Middleware\HandleCors::class,
        \Illuminate\Foundation\Http\Middleware\PreventRequestsDuringMaintenance::class,
        \Illuminate\Http\Middleware\ValidatePostSize::class,
        \Illuminate\Foundation\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ]);
})
```
If you would like to assign middleware to specific routes, you may invoke the `middleware` method when defining the route:
```php
use App\Http\Middleware\EnsureTokenIsValid;

Route::get('/profile', function () {
    // ...
})->middleware(EnsureTokenIsValid::class);
```
## Related Commands

* **make:controller** - The target where the request is passed after the middleware has run.
* **route:list** - Displays which middlewares are attached to each route.
* **make:job-middleware** - Used for adding processing logic to queued tasks instead of HTTP requests.



# make:exception

**Category**: Code Generation & Error Handling

**Related**: make:controller, make:class, report, render

---

## Description

The `make:exception` command creates a new **Exception Class** in your `app/Exceptions` directory. Custom exceptions provide a clean, semantic way to signal errors or conditions that interrupt the normal flow of execution in your application's logic.

Using dedicated exception classes improves code readability and allows Laravel's Exception Handler (`App\Exceptions\Handler.php`) to easily distinguish and handle different error types.

---

## When to Use This Command

- When defining a specific failure condition within a service or repository (e.g., `UserNotFoundException`, `InsufficientFundsException`).
- When you need a custom exception that requires its own unique rendering logic (e.g., returning a specific JSON structure or HTTP status code).
- To create a **renderable** or **reportable** exception that interacts directly with the framework's error handling pipeline.

---

## Basic Usage

The command requires the name you wish to give your Exception Class.

`php artisan make:exception InvalidArgumentException`

---

## Available Options

| Option | Shortcut | Description |
| :--- | :--- | :--- |
| **--render** | | Indicates that the exception should include a `render()` method boilerplate for custom HTTP responses. |
| **--report** | | Indicates that the exception should include a `report()` method boilerplate for custom logging or external reporting. |
| **--force** | | Create the class even if the exception already exists. |

---

## Practical Examples

Create a basic custom exception:
`php artisan make:exception ModelNotFoundException`

Create an exception with custom rendering logic (e.g., for API errors):
`php artisan make:exception InsufficientPermissionException --render`

Create an exception that reports to a third-party service:
`php artisan make:exception PaymentFailedException --report`

---

## Generated Exception File

The command generates a file, for example `app/Exceptions/InsufficientPermissionException.php`, with a base structure extending the standard PHP `Exception` class:

```php
<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;

class InsufficientPermissionException extends Exception
{
    /**
     * Report the exception.
     */
    public function report()
    {
        // Custom logic for logging or sending to an error tracker (e.g., Sentry)
    }

    /**
     * Render the exception into an HTTP response.
     */
    public function render(Request $request)
    {
        return response()->json([
            'message' => 'You do not have the required permission.',
        ], 403);
    }
}
```
### Usage

The exception is thrown when the specific error condition is met:
```php
if (!$user->can('perform-action')) {
    throw new InsufficientPermissionException();
}
```
## Related Commands

* **make:controller** - Often where exceptions are caught or thrown to handle request-specific errors.
* **make:class** - Used for general purpose classes when a dedicated exception is overkill.
* **optimize** - Ensures that framework components, including error handling, are efficiently loaded.

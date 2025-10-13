# make:rule

**Category**: Code Generation & Validation

**Related**: make:request, make:controller, validate

---

## Description

The `make:rule` command creates a new **Custom Validation Rule Class** in your `app/Rules` directory. These classes implement the `Illuminate\Contracts\Validation\Rule` interface (or the `InvokableRule` interface for single-action classes) and allow you to encapsulate complex, reusable validation logic that cannot be easily expressed with Laravel's built-in validation strings.

Custom Rule classes make your validation code cleaner and promote reusability across multiple form requests or controller validation calls.

---

## When to Use This Command

- When validation requires complex logic that spans multiple database queries or service calls (e.g., checking if a username is unique across multiple tenancy scopes).
- To define a business-specific rule that must be reused in various parts of the application (e.g., `ValidCouponCode`).
- To provide a dedicated, easily readable error message alongside the complex logic.

---

## Basic Usage

The command requires the name you wish to give your Rule Class.

`php artisan make:rule Uppercase`

---

## Available Options

| Option | Shortcut | Description |
| :--- | :--- | :--- |
| **--invokable** | **-i** | Create a single-action rule class with the `__invoke` method, which is generally the preferred modern approach. |
| **--force** | | Create the class even if the rule already exists. |

---

## Practical Examples

Create a standard rule class (implements `passes` and `message`):
`php artisan make:rule StrongPassword`

Create an invokable rule class (recommended):
`php artisan make:rule ValidDomain --invokable`

---

## Generated Rule File (Invokable)

The command generates a file, for example `app/Rules/ValidDomain.php`, when using the `--invokable` option:

```php
<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidDomain implements ValidationRule
{
    /**
     * Run the validation rule.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Example: Ensure the value is not from a disposable email domain
        if (str_ends_with($value, '@disposable.com')) {
            $fail('The :attribute domain is not allowed.');
        }
    }
}
```
### Usage

The rule is used by passing an instance of the class into the validation rules array:
```php
// In a Form Request or Controller validation call

use App\Rules\ValidDomain;

$request->validate([
    'email' => ['required', new ValidDomain],
]);
```
## Related Commands

* **make:request** - The most common location where custom rules are applied.
* **make:controller** - Used for handling requests where validation might be performed inline.
* **make:model** - If the rule interacts with database logic (e.g., uniqueness checks).

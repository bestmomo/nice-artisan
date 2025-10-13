# make:request

**Category**: Code Generation & HTTP

**Related**: make:controller, validate, Form Request

---

## Description

The `make:request` command creates a new **Form Request Class** in your `app/Http/Requests` directory. Form Requests are specialized classes used to encapsulate validation logic and authorization checks for incoming HTTP requests.

They decouple complex validation rules from your controllers, resulting in cleaner, more readable, and more maintainable action methods.

---

## When to Use This Command

- When validating user input (e.g., creating a new user, updating a post) where the rules are complex or numerous.
- When the request requires an authorization check to determine if the currently authenticated user is allowed to perform the action.
- To keep controllers focused solely on handling the business logic, not the validation setup.

---

## Basic Usage

The command requires the name you wish to give your Form Request Class, typically reflecting the action it validates.

`php artisan make:request StorePostRequest`

---

## Available Options

| Option | Shortcut | Description |
| :--- | :--- | :--- |
| **--force** | | Create the class even if the request already exists. |

---

## Practical Examples

Create a request to validate user creation:
`php artisan make:request CreateUserRequest`

Create a request to validate a password change:
`php artisan make:request UpdatePasswordRequest`

---

## Generated Request File

The command generates a file, for example `app/Http/Requests/StorePostRequest.php`, with the following base structure:

```php
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Change this to true to allow the request for authenticated users, 
        // or add custom authorization logic (e.g., check user roles/permissions).
        return true; 
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            // 'title' => 'required|string|max:255',
            // 'body' => 'required|string',
        ];
    }
}
```
### Usage

The Form Request is used by type-hinting it in the controller method. Laravel automatically executes the `authorize()` and `rules()` methods before the controller body runs.
```php
// In PostController.php

use App\Http\Requests\StorePostRequest;

public function store(StorePostRequest $request)
{
    // Validation and authorization have already passed.
    // Logic to create the post using $request->validated()
}
```
## Related Commands

* **make:controller** - The controller where the Form Request will be type-hinted and executed.
* **make:policy** - Used for resource authorization, while Form Requests combine validation and request-level authorization.
* **route:list** - Displays the HTTP routes that the Form Requests protect.

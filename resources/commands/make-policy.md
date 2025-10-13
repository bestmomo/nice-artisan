# make:policy

**Category**: Code Generation & Authorization

**Related**: make:model, make:request, can

---

## Description

The `make:policy` command creates a new **Authorization Policy Class** in your `app/Policies` directory. Policies are used to organize authorization logic around a particular **model or resource** (e.g., `PostPolicy` handles all permissions related to a `Post` model).

Policies centralize high-level rules such as “Can a user update this article?” or “Can a user view the list of users?”. They are typically registered and checked using the `Gate` facade or the `$user->can()` method.

---

## When to Use This Command

- When defining authorization rules for **Eloquent models** (the most common use case).
- To keep your controllers clean by delegating complex permission checks to a dedicated class.
- When you need to define methods for standard CRUD actions (`viewAny`, `view`, `create`, `update`, `delete`, `restore`, `forceDelete`).

---

## Basic Usage

The command requires the name you wish to give your Policy Class, often suffixed with `Policy`.

`php artisan make:policy PostPolicy`

---

## Available Options

| Option | Shortcut | Description |
| :--- | :--- | :--- |
| **--model** | **-m** | Specify the Eloquent model that the policy applies to, automatically generating the CRUD methods. |
| **--force** | | Create the class even if the policy already exists. |

---

## Practical Examples

Create a policy for the `User` model, including CRUD methods:
`php artisan make:policy UserPolicy -m=User`

Create a policy without a model (for non-model-specific actions):
`php artisan make:policy SettingsPolicy`

---

## Generated Policy File

The command generates a file, for example `app/Policies/PostPolicy.php`. If the `--model=Post` option is used, the file will include the standard CRUD methods:

```php
<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Post;
use Illuminate\Auth\Access\Response;

class PostPolicy
{
    // The model is passed as an argument when --model is used
    
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        // Example: Only authenticated users can view the list
        return $user !== null;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Post $post): bool
    {
        // Example: Only the post owner can update the post
        return $user->id === $post->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Post $post): bool
    {
        // Example: Allow deletion if the user is the owner OR an administrator
        return $user->id === $post->user_id || $user->is_admin;
    }
}
```

### Registration

By default, Laravel automatically discover policies as long as the model and policy follow standard Laravel naming conventions. 

Using the `Gate` facade, you may manually register policies and their corresponding models within the boot method of your application's `AppServiceProvider`:
```php
use App\Models\Order;
use App\Policies\OrderPolicy;
use Illuminate\Support\Facades\Gate;

/**
 * Bootstrap any application services.
 */
public function boot(): void
{
    Gate::policy(Order::class, OrderPolicy::class);
}
```
### Usage
For example, let's determine if a user is authorized to update a given App\Models\Post model. Typically, this will be done within a controller method:
```php
<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Update the given post.
     */
    public function update(Request $request, Post $post): RedirectResponse
    {
        if ($request->user()->cannot('update', $post)) {
            abort(403);
        }

        // Update the post...

        return redirect('/posts');
    }
}
```
## Related Commands

* **make:model** - The model that the policy governs.
* **make:request** - Used for form validation, while policies handle authorization.
* **auth:clear-resets** - A utility command related to authentication systems.




# make:observer

**Category**: Code Generation & Eloquent

**Related**: make:model, make:event, listeners

---

## Description

The `make:observer` command creates a new **Eloquent Observer Class** in your `app/Observers` directory. Observers are specialized classes designed to centralize event-handling logic for a single Eloquent model.

They listen for multiple model events (like `creating`, `updating`, `deleting`, `retrieved`) and define corresponding methods to handle those actions, offering a cleaner alternative to registering all event listeners for a model within its boot method.

---

## When to Use This Command

- When you have **many listeners or handlers** related to the lifecycle of a *single* model.
- To keep the model class clean by moving all related event handling logic into a dedicated, organized class.
- To perform side-effects (e.g., logging, updating a related counter, clearing cache) whenever a model is saved, deleted, or retrieved.

---

## Basic Usage

The command requires the name you wish to give your Observer Class, often suffixed with `Observer`.

`php artisan make:observer UserObserver`

---

## Available Options

| Option | Shortcut | Description |
| :--- | :--- | :--- |
| **--model** | **-m** | Specify the Eloquent model that the observer will watch. |
| **--force** | | Create the class even if the observer already exists. |

---

## Practical Examples

Create an observer for the `Post` model:
`php artisan make:observer PostObserver -m=Post`

Create an observer for a model nested in a directory (`Blog/Comment`):
`php artisan make:observer Blog/CommentObserver -m=Blog/Comment`

---

## Generated Observer File

The command generates a file, for example `app/Observers/UserObserver.php`, with the following base structure. It includes methods for the most common events:

```php
<?php

namespace App\Observers;

use App\Models\User;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        // Logic to run after a User is inserted into the database
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        // Logic to run after a User is modified
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        // Logic to run after a User is soft-deleted or permanently deleted
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        // Logic to run after a soft-deleted User is restored
    }
}
```
### Registration

After creation, the observer must be registered, typically within the `boot()` method of your `App\Providers\EventServiceProvider.php`:
```php
// In EventServiceProvider.php

use App\Models\User;
use App\Observers\UserObserver;

public function boot(): void
{
    User::observe(UserObserver::class);
}
```
## Related Commands

* **make:model** - The model that the observer is designed to watch.
* **make:event** - Used when creating events that are dispatched by the model, which are then handled by separate listeners.
* **event:list** - Displays a list of all registered events, including those implicitly handled by Observers.

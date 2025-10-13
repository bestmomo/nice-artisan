# make:listener

**Category**: Code Generation & Events

**Related**: make:event, make:subscriber, event:list

---

## Description

The `make:listener` command creates a new **Event Listener Class** in your `app/Listeners` directory. Listeners are classes that contain the logic to be executed whenever a specific **Event** is dispatched by the application.

This mechanism promotes decoupling: the event dispatcher doesn't care who is listening or what they do; it simply announces that something happened.

---

## When to Use This Command

- When defining the action that should occur in response to an event (e.g., sending a welcome email after a `UserRegistered` event).
- When a single event should trigger multiple, distinct side effects in different parts of your application.
- When creating a listener for a task that is too slow to run synchronously, requiring it to be queued.

---

## Basic Usage

The command requires the name you wish to give your Listener Class.

`php artisan make:listener SendWelcomeEmail`

---

## Available Options

| Option | Shortcut | Description |
| :--- | :--- | :--- |
| **--event** | | Specify the event class that this listener will handle. |
| **--queued** | **-q** | Indicates that the listener should be queued (implementing `ShouldQueue`) for asynchronous execution. |
| **--force** | | Create the class even if the listener already exists. |

---

## Practical Examples

Create a basic synchronous listener:
`php artisan make:listener LogUserActivity --event=UserRegistered`

Create a listener that will run in the background via the queue:
`php artisan make:listener ProcessOrderAfterPayment --queued`

---

## Generated Listener File

The command generates a file, for example `app/Listeners/SendWelcomeEmail.php`, with the following base structure:

```php
<?php

namespace App\Listeners;

use App\Events\UserRegistered; // Assuming this event was passed with --event
use Illuminate\Contracts\Queue\ShouldQueue; // Included if --queued is used
use Illuminate\Queue\InteractsWithQueue;

class SendWelcomeEmail
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserRegistered $event): void
    {
        // Access event data via the $event object (e.g., $event->user)
        // Logic to send the email goes here
    }
}
```
### Registration

The listener must be registered in the `$listen` array of your `App\Providers\EventServiceProvider.php`:
```php
protected $listen = [
    \App\Events\UserRegistered::class => [
        \App\Listeners\SendWelcomeEmail::class,
    ],
];
```
## Related Commands

* **make:event** - Used to create the event that this listener handles.
* **make:subscriber** - Used to group multiple listeners and events within a single class.
* **event:list** - Displays a list of all registered events and their listeners.
* **queue:work** - The command required to process any listener created with the --queued option.

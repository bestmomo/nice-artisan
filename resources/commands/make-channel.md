# make:channel

**Category**: Code Generation & Broadcasting

**Related**: make:event, make:listener, routes/channels.php

---

## Description

The `make:channel` command creates a new Channel class in your `app/Broadcasting` directory. Channel classes are used to authorize user access to specific broadcast channels (using WebSockets) and to define the logic for authorizing the subscription.

Laravel uses these classes to determine if a currently authenticated user can listen to a private or presence channel.

---

## When to Use This Command

- When defining a new private channel (e.g., `private-chat.{roomId}`) that requires authorization logic.
- When defining a new presence channel (e.g., `presence-users-online`) that requires both authorization and membership data logic.
- To separate complex authorization logic from your main `routes/channels.php` file.

---

## Basic Usage

The command requires the desired name of the Channel class.

`php artisan make:channel NewOrderChannel`

---

## Available Options

| Option | Shortcut | Description |
| :--- | :--- | :--- |
| **--force** | | Create the class even if the channel already exists. |

---

## Practical Examples

Create a private channel class:
`php artisan make:channel ConversationChannel`

Create a channel class that overwrites an existing file:
`php artisan make:channel StatusUpdateChannel --force`

---

## Generated Channel File

The command generates a file, for example `app/Broadcasting/NewOrderChannel.php`, with the following structure:

```php
<?php

namespace App\Broadcasting;

class NewOrderChannel
{
    /**
     * Create a new channel instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Authenticate the user's access to the channel.
     *
     * @param  \App\Models\User  $user
     * @return array|bool
     */
    public function join($user)
    {
        // Add your authorization logic here
        return true; 
    }
}
```
#### Registration and Authorization

After creating the Channel class, you must register it in your routes/channels.php file:
```
use App\Broadcasting\NewOrderChannel;

Broadcast::channel('orders.{orderId}', NewOrderChannel::class);
```
The arguments passed to the join method ($orderId in this case) are derived from the channel wildcard in the registration.

#### Related Commands

* **make:event** - Used to create the event that will be broadcast on the channel.
* **make:listener** - Used to create the listener that may respond to broadcast events.
* **event:list** - Displays a list of all registered events and their listeners.

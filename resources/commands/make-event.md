# make:event

**Category**: Code Generation & Events

**Related**: make:listener, make:subscriber, dispatch, broadcast

---

## Description

The `make:event` command creates a new **Event Class** in your `app/Events` directory. Events are a core part du mécanisme d'observabilité de Laravel, permettant de découpler des actions. Lorsqu'un événement est déclenché (dispatched), il peut être capturé par un ou plusieurs **Listeners** qui exécutent des actions spécifiques.

Les événements sont essentiels pour gérer les effets secondaires de l'application de manière asynchrone ou non bloquante.

---

## When to Use This Command

- When an important action or change of state occurs in your application (e.g., `UserRegistered`, `OrderShipped`).
- When you need to notify multiple, différents composants de l'application qu'un événement s'est produit.
- When preparing an event for **broadcasting** (diffusion en temps réel) à l'aide de WebSockets.

---

## Basic Usage

The command requires the name you wish to give your Event Class.

`php artisan make:event OrderShipped`

---

## Available Options

| Option | Shortcut | Description |
| :--- | :--- | :--- |
| **--broadcast** | | Indicates that the generated event should implement the `ShouldBroadcast` interface for real-time delivery. |
| **--force** | | Create the class even if the event already exists. |

---

## Practical Examples

Create a standard event:
`php artisan make:event PostCreated`

Create an event designed for real-time broadcasting:
`php artisan make:event UserLoggedIn --broadcast`

---

## Generated Event File

The command generates a file, for example `app/Events/OrderShipped.php`, with the following base structure:

```php
<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OrderShipped
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct()
    {
        // Les propriétés publiques passées ici seront disponibles dans les listeners
    }
}
```
### Dispatching the Event

The event is typically triggered within your application logic:
```php
// Dispatching the event and passing data (e.g., an Order model)
event(new OrderShipped($order));
```
## Related Commands

* **make:listener** - Creates the class that will handle (listen to) this event.
* **make:subscriber** - Creates a class that can register multiple listeners for various events.
* **event:list** - Displays a list of all registered events and their associated listeners.
* **make:channel** - Used when defining the authorization for the channel on which a broadcast event will be sent.

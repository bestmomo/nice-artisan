# make:enum

**Category**: Code Generation & PHP

**Related**: make:class, make:model, make:interface

---

## Description

The `make:enum` command creates a new PHP **Enumeration (Enum) Class** in your `app/Enums` directory (or another directory if configured). Enums provide a way to define a fixed set of named values, making your code safer, more expressive, and easier to refactor than using raw string or integer constants.

This command is available in Laravel applications running on PHP 8.1 or newer.

---

## When to Use This Command

- When defining a fixed, limited list of options for a status (e.g., `OrderStatus`).
- When defining discrete types for a model property (e.g., `UserRole` or `PaymentMethod`).
- When replacing class constants or magic strings/integers with type-safe values.
- When preparing values to be used with Laravel's built-in **Enum Casting** on Eloquent models.

---

## Basic Usage

The command requires the desired name for the Enum class.

`php artisan make:enum OrderStatus`

---

## Available Options

| Option | Shortcut | Description |
| :--- | :--- | :--- |
| **--force** | | Create the enum even if a file with the given name already exists. |

---

## Practical Examples

Create a basic enumeration:
`php artisan make:enum UserRole`

Create an enumeration in a subdirectory:
`php artisan make:enum Models/SubscriptionType`

---

## Generated Enum File

The command generates a file, for example `app/Enums/OrderStatus.php`, with the following minimal structure:

```php
<?php

namespace App\Enums;

enum OrderStatus
{
    // Define your cases here
    // case Pending;
    // case Processing;
    // case Completed;
}
```
### Backed Enum Example

Enums can be backed by strings or integers for storage in a database:
```php
<?php

namespace App\Enums;

enum OrderStatus: string // Backed by string
{
    case Pending = 'pending';
    case Processing = 'processing';
    case Completed = 'completed';
}
```
##### Usage with Eloquent

The enum is typically used in a model's $casts property:
```php
// In an Order model
protected $casts = [
    'status' => OrderStatus::class,
];
```
## Related Commands

* **make:model** - The model where the enum will be cast.
* **make:cast** - Used for complex data transformation, whereas enums handle fixed value sets.
* **make:class** - Used for general purpose PHP classes.



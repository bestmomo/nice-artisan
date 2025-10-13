# make:cast

**Category**: Code Generation & Eloquent

**Related**: make:model, make:trait

---

## Description

The `make:cast` command creates a new custom **Cast Class** for use with Laravel's Eloquent models. Custom casts allow you to manage complex or unconventional data types and their serialization/deserialization logic when storing and retrieving them from the database.

This provides a cleaner alternative to defining accessors and mutators directly on your model for data transformation logic.

---

## When to Use This Command

- When you need to transform a complex PHP object (like a Value Object, Collection, or Enum) into a simple database type (e.g., JSON string) and back.
- When you have a recurring data transformation requirement across multiple Eloquent models.
- When replacing traditional accessors and mutators with a dedicated class for better separation of concerns.

---

## Basic Usage

The command requires the name you wish to give your Cast Class.

`php artisan make:cast MoneyCast`

---

## Available Options

| Option | Shortcut | Description |
| :--- | :--- | :--- |
| **--inbound** | | Generate an inbound-only cast class (implements `InboundCast` instead of `CastsAttributes`). |

---

## Practical Examples

Create a standard Cast Class:
`php artisan make:cast PriceCast`

Create an Inbound-Only Cast (used only when setting data on the model):
`php artisan make:cast HashValueCast --inbound`

---

## Generated Cast File

The command generates a file, for example `app/Casts/MoneyCast.php`, with the following structure (for a standard `CastsAttributes`):

```php
<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

class MoneyCast implements CastsAttributes
{
    /**
     * Cast the given value from the database.
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        // Logic to transform database value into PHP value
        return $value;
    }

    /**
     * Prepare the given value for storage.
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        // Logic to transform PHP value into database value
        return $value;
    }
}
```

## Usage on a Model

Once created, the cast is applied in the $casts array of the model:

```php
// In a User model
protected $casts = [
    'price' => MoneyCast::class,
];
```
## Related Commands

    make:model - Creates the model where the custom cast will be used.

    make:trait - Generates a Trait, which is sometimes used for reusable model logic, similar to casts.

# make:class

**Category**: Code Generation & PHP

**Related**: make:model, make:interface, make:trait, make:enum

---

## Description

The `make:class` command creates a new, blank PHP class file. Unlike specialized `make:*` commands (like `make:model` or `make:controller`), this command generates a minimal class structure without any predefined dependencies, methods, or interfaces.

This is the preferred command for quickly scaffolding utility classes, services, repositories, or any other component that doesn't fit into Laravel's core architecture types.

---

## When to Use This Command

- When creating a **Service Class** to encapsulate business logic (e.g., `PaymentService`).
- When defining a **Repository Class** to abstract data access logic.
- When generating a **Value Object** or **Data Transfer Object (DTO)**.
- For creating any general-purpose utility class that needs to be organized under an appropriate namespace.

---

## Basic Usage

The command requires the path and name of the class to be created.

`php artisan make:class Services/Mailer`

---

## Available Options

| Option | Shortcut | Description |
| :--- | :--- | :--- |
| **--force** | | Create the class even if a class with the given name already exists. |

---

## Practical Examples

Create a utility class in the root `app/` directory:
`php artisan make:class CustomHelper`

Create a service class in a new subdirectory:
`php artisan make:class Services/ExternalApi`

Create a repository class:
`php artisan make:class Repositories/UserRepository`

---

## Generated Class File

The command generates a file, for example `app/Services/Mailer.php`, with the following base structure:

```php
<?php

namespace App\Services;

class Mailer
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
}
```
This minimal structure allows you to immediately begin defining your own properties and methods for the class.

## Related Commands

* **make:interface** - Generates a new PHP interface.
* **make:trait** - Generates a new PHP trait.
* **make:enum** - Generates a new PHP enum class (Laravel 9.x+).
* **make:model** - Generates a class with Eloquent specific logic.

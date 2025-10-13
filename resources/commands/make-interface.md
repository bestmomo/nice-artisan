# make:interface

**Category**: Code Generation & PHP

**Related**: make:class, make:trait, make:model

---

## Description

The `make:interface` command creates a new **PHP Interface** file. An interface defines a contract for the methods that a class must implement, without defining the content of those methods.

Interfaces are a fundamental concept in Object-Oriented Programming (OOP) for achieving **polymorphism** and establishing clear contracts between different layers or components of your application.

---

## When to Use This Command

- When defining a contract for a service, repository, or driver that will have multiple concrete implementations (e.g., `PaymentGateway` interface implemented by `StripeGateway` and `PayPalGateway`).
- When defining behavior that multiple unrelated classes should share (e.g., a `Sortable` interface).
- To adhere to the Dependency Inversion Principle (DIP) and allow for easy swapping of concrete classes in Laravel's Service Container.

---

## Basic Usage

The command requires the name you wish to give your Interface. It is standard practice to prefix interfaces with `I` or suffix them with `Interface`.

`php artisan make:interface Services/PaymentGatewayInterface`

---

## Available Options

| Option | Shortcut | Description |
| :--- | :--- | :--- |
| **--force** | | Create the interface even if a file with the given name already exists. |

---

## Practical Examples

Create a contract for a data repository:
`php artisan make:interface Repositories/UserRepositoryInterface`

Create a contract for a service implementation:
`php artisan make:interface Contracts/QueueableInterface`

---

## Generated Interface File

The command generates a file, for example `app/Services/PaymentGatewayInterface.php`, with the following base structure:

```php
<?php

namespace App\Services;

interface PaymentGatewayInterface
{
    // Define public method signatures here without implementation
    // public function charge(float $amount): bool;
    // public function refund(string $transactionId): bool;
}
```
### Usage

The interface is then implemented by concrete classes:
```php
use App\Services\PaymentGatewayInterface;

class StripeGateway implements PaymentGatewayInterface
{
    public function charge(float $amount): bool
    {
        // Stripe specific logic
    }
    
    // ... must also define refund()
}
```
## Related Commands

* **make:class** - Used to create the concrete classes that will implement the interface.
* **make:trait** - Used for code reuse, while interfaces are used for defining contracts.
* **make:model** - Models can implement custom interfaces (e.g., MustVerifyEmail interface).

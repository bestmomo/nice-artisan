# make:test

**Category**: Code Generation & Testing

**Related**: make:unit, make:feature, phpunit, test

---

## Description

The `make:test` command creates a new **Test Class** in your application's `tests` directory. Test classes are essential for verifying the behavior and correctness of your application code. By default, the command places the file in `tests/Feature`, but you can specify a Unit test.

Tests written in Laravel generally extend either `Tests\TestCase` (for application tests) or `PHPUnit\Framework\TestCase` (for pure unit tests).

---

## When to Use This Command

- When writing **Feature Tests** to verify HTTP interactions (routes, controllers, middleware).
- When writing **Unit Tests** to verify individual, isolated components (models, service classes, simple methods).
- As the standard way to prepare a file for test-driven development (TDD) or general quality assurance.

---

## Basic Usage

The command requires the name you wish to give your Test Class, typically descriptive of the component being tested.

`php artisan make:test UserRegistrationTest`

---

## Available Options

| Option | Shortcut | Description |
| :--- | :--- | :--- |
| **--unit** | **-u** | Indicates that the test should be a **Unit Test**, placing it in `tests/Unit`. |
| **--pest** | | Indicates that the test should be generated as a **Pest PHP** file instead of a PHPUnit class. |
| **--force** | | Create the class even if the test already exists. |

---

## Practical Examples

Create a Feature Test (default location: `tests/Feature`):
`php artisan make:test ApiAuthenticationTest`

Create a Unit Test (location: `tests/Unit`):
`php artisan make:test ServiceClassTest --unit`

Create a Pest Test (requires Pest installed):
`php artisan make:test UserCanLoginTest --pest`

---

## Generated Test File (Feature Test)

The command generates a file, for example `tests/Feature/UserRegistrationTest.php`, with the following base structure:

```php
<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserRegistrationTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_user_can_register(): void
    {
        // Example: Asserting an HTTP status after a post request
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertStatus(302); // Check for redirect
        // $this->assertDatabaseHas('users', ['email' => 'test@example.com']); 
    }
}
```
### Execution

All tests are executed using the main test command:

`php artisan test`

## Related Commands

* **test** - Executes the PHPUnit or Pest test suite.
* **make:model** - Tests often interact with the models created by this command.
* **db:seed** - Used to prepare the database with test data, often combined with `RefreshDatabase` trait.

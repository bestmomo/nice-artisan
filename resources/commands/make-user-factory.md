# make:user-factory (Laravel 12+)

**Category**: Code Generation & Database

**Related**: make:factory, make:model, db:seed, User Model

**Note**: _The standard command in recent versions of Laravel is `make:factory` and often generates the default `UserFactory` if it does not exist. This specific command (`make:user-factory`) is typically an alias or a command provided by a starter kit such as Breeze or Jetstream to ensure the creation of the user-specific factory, but it is managed by the same basic system._

---

## Description

The `make:user-factory` command is used to create an **Eloquent Model Factory** specifically for the application's default **`App\Models\User`** model. This factory class, usually located in `database/factories/UserFactory.php`, defines a blueprint for creating fake or dummy users for testing and database seeding purposes.

It's crucial for efficiently generating realistic user data, complete with names, emails, and hashed passwords.

---

## When to Use This Command

- When setting up your development environment and needing to generate a large number of fake users quickly.
- When writing **Feature Tests** that require authenticated users or specific user roles for setup.
- To define the standard set of attributes and their fake data generators (using the Faker library) for the `User` model.

---

## Basic Usage

This command does not typically require any arguments, as the target model (`User`) is implicit.

`php artisan make:user-factory`

---

## Available Options

| Option | Shortcut | Description |
| :--- | :--- | :--- |
| **--force** | | Create the class even if the factory already exists. |

---

## Practical Examples

Generate the User factory class:
`php artisan make:user-factory`

---

## Generated Factory File

The command generates or overwrites the `database/factories/UserFactory.php` file, which includes the definition of the factory state, often containing a standard definition for the user attributes:

```php
<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }
    
    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
```
### Usage

The factory is used to create data in tests or seeders:
```php
// In a Seeder
use App\Models\User;

public function run(): void
{
    User::factory(50)->create();
    
    // Create an unverified user
    User::factory()->unverified()->create();
}
```
## Related Commands

* **make:factory** - The generic command for creating factories for any other model.
* **db:seed** - Used to execute the seeder classes, which in turn use this factory.
* **make:seeder** - Used to create the class that calls this factory.

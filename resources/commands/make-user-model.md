# make:user-model

**Category**: Code Generation & Eloquent

**Related**: make:model, make:migration, make:factory, auth:install

**Note**: _Historically, in older versions of Laravel (prior to Laravel 11), the User model was created by default. In modern versions (Laravel 11+), using `make:model` with the `--user` or `--factory` option is often encouraged. This specific command (`make:user-model`) may be an alias command or a legacy command, but it refers to the creation of the basic user model._

---

## Description

The `make:user-model` command creates a new **Eloquent Model Class** specifically named **`User`** in your `app/Models` directory. This model is the fundamental class representing authenticated users in a Laravel application. It is pre-configured to use the necessary traits and interfaces for authentication, notifications, and, often, API tokens.

This command ensures the creation of the canonical `User` model required by the authentication system.

---

## When to Use This Command

- When setting up the application structure and you need the base `User` model defined.
- After a custom installation where the default `User` model was not automatically provided.
- To ensure the model includes all standard traits, like `Notifiable` and `HasFactory`.

---

## Basic Usage

This command does not typically require any arguments, as the model name (`User`) is implicit.

`php artisan make:user-model`

---

## Available Options

*Note: This command primarily generates the model file, but its functionality is often wrapped by `make:model` with specific flags.*

| Option | Shortcut | Description |
| :--- | :--- | :--- |
| **--factory** | **-f** | Create a corresponding **Factory** (`UserFactory.php`) for the model. |
| **--migration** | **-m** | Create a corresponding **Migration** (`create_users_table`) for the model. |
| **--force** | | Create the class even if the model already exists. |

---

## Practical Examples

Create the User model along with its migration and factory (most common usage):
`php artisan make:user-model -mf`

---

## Generated Model File

The command generates a file, for example `app/Models/User.php`, with the following base structure:

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens; // Often included if Sanctum is installed

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
```
## Related Commands

* **make:model** - The generic command for creating any other Eloquent model.
* **make:migration** - Used to create the `users` table schema, essential for the model to work.
* **make:factory** - Used to create data blueprints for the `User` model.
* **auth:install** - Installs the front-end scaffolding and often includes the `User` model setup.

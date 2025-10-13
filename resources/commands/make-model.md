# make:model

**Category**: Code Generation

**Related**: make:migration, make:controller, make:factory, db:seed, migrate

## Description

The make:model command creates a new Eloquent model class in your Laravel application. Eloquent is Laravel's built-in ORM system that provides an elegant, ActiveRecord implementation for working with your database.

## When to Use This Command

- Starting a new feature that requires database interaction
- Adding a new table to your database schema
- Defining relationships between different database entities
- Creating API resources that need to return model data

## Basic Usage

`php artisan make:model User`

## Available Options

* **--all**, **-a**: Generate a migration, factory, and resource controller for the model
* **--controller**, **-c**: Create a new controller for the model
* **--factory**, **-f**: Create a new factory for the model
* **--force**: Create the class even if the model already exists
* **--migration**, **-m**: Create a new migration file for the model
* **--policy**: Create a new policy for the model
* **--seed**, **-s**: Create a new seeder for the model
* **--pivot**, **-p**: Indicates if the generated model should be a custom intermediate table model
* **--resource**, **-r**: Indicates if the generated controller should be a resource controller
* **--api**: Indicates if the generated controller should be an API resource controller

## Practical Examples

Basic model:
`php artisan make:model User`

Model with migration:
`php artisan make:model Product -m`

Model with multiple resources:
`php artisan make:model Order -mfc`

Using the --all flag:
`php artisan make:model Post --all`

Pivot model:
`php artisan make:model RoleUser -p`

API resource controller:
`php artisan make:model Product -mc --api`

## Generated Model File
```
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}

## Defining Relationships

// In User model
public function posts()
{
    return $this->hasMany(Post::class);
}

public function roles()
{
    return $this->belongsToMany(Role::class);
}

// In Post model
public function user()
{
    return $this->belongsTo(User::class);
}
```
## Pro Tips

- Use the -m flag by default to save time
- Define relationships in your model immediately after creation
- Use \$fillable or \$guarded for mass assignment protection
- Leverage model events for automatic actions
- Use accessors and mutators for data transformation
- Define query scopes for reusable query logic

## Common Next Steps

1. Run migrations:
`php artisan migrate`

2. Seed the database:
`php artisan db:seed`

3. Create a controller:
`php artisan make:controller UserController --resource`

## Related Commands

- **make:migration** - Create database migrations
- **make:controller** - Generate controller classes
- **make:factory** - Create model factories for testing
- **migrate** - Run pending migrations
- **db:seed** - Populate database with sample data

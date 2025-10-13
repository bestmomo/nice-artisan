# make:factory

**Category**: Code Generation & Testing

**Related**: make:model, db:seed, test

---

## Description

The `make:factory` command creates a new **Eloquent Model Factory Class** in your `database/factories` directory. Factories are classes used to generate fake or dummy instances of your Eloquent models.

They are an indispensable tool for writing robust tests and for seeding your database with large amounts de données réalistes, simplifiant grandement le processus de configuration de l'environnement.

---

## When to Use This Command

- When setting up your **Unit and Feature Tests** to rapidly create models with various states (e.g., a "draft" post, an "active" user).
- When preparing a **Seeder** to populate your development or testing database with substantial, non-production data.
- Whenever you define a new Eloquent model that nécessitera la création d'instances pour le développement ou les tests.

---

## Basic Usage

The command requires the name you wish to give your Factory Class, typically derived from the model it represents.

`php artisan make:factory PostFactory`

---

## Available Options

| Option | Shortcut | Description |
| :--- | :--- | :--- |
| **--model** | **-m** | Specify the Eloquent model that the factory will generate. |
| **--force** | | Create the factory even if a file with the given name already exists. |

---

## Practical Examples

Create a factory for the `User` model:
`php artisan make:factory UserFactory -m=User`

Create a factory for a model nested in a directory (`Models/Blog/Post`):
`php artisan make:factory Blog/PostFactory -m=Blog/Post`

---

## Generated Factory File

The command generates a file, for example `database/factories/PostFactory.php`, with the following base structure:

```php
<?php

namespace Database\Factories;

use App\Models\Post; // Imported if --model option is used
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class; // <-- Set by --model option

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // Example:
            // 'title' => $this->faker->sentence(),
            // 'content' => $this->faker->paragraph(),
            // 'user_id' => User::factory(), // Relationships are easy!
        ];
    }
}
```
### Usage

Factories are used via the model's static `factory()` method:
```php
// Create and save a single post
Post::factory()->create();

// Create 5 posts and save them to the database
Post::factory()->count(5)->create();

// Create a post with a specific attribute
Post::factory()->create(['title' => 'Important Announcement']);
```
## Related Commands

* **make:model** - Used to create the model that the factory will manage.
* **db:seed** - Used to run seeders, which often utilize factories to generate large datasets.
* **test** - The primary command for running tests that rely heavily on factories for setup.

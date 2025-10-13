# make:seeder

**Category**: Code Generation & Database

**Related**: db:seed, make:factory, migrate:fresh

---

## Description

The `make:seeder` command creates a new **Database Seeder Class** in your `database/seeders` directory. Seeders are used to populate your database with initial data, often used for setting up the development environment, creating a default administrator user, or loading lookup data (e.g., countries, roles).

The logic within a Seeder class defines the data to be inserted into the database, typically leveraging Eloquent Models and Factories.

---

## When to Use This Command

- When defining default data that must be present in the database after a fresh migration (e.g., initial user roles).
- When preparing large amounts of realistic dummy data for testing or development using Model Factories.
- To organize the logic for populating different parts of your database schema.

---

## Basic Usage

The command requires the name you wish to give your Seeder Class, often reflecting the data it populates.

`php artisan make:seeder PostsTableSeeder`

---

## Available Options

| Option | Shortcut | Description |
| :--- | :--- | :--- |
| **--force** | | Create the class even if the seeder already exists. |

---

## Practical Examples

Create a seeder for the `User` model:
`php artisan make:seeder UserSeeder`

Create a seeder for application settings:
`php artisan make:seeder SettingsSeeder`

---

## Generated Seeder File

The command generates a file, for example `database/seeders/UserSeeder.php`, with the following base structure:

```php
<?php

namespace Database\Seeders;

use App\Models\User; // Example model usage
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Example 1: Creating a single record manually
        DB::table('users')->insert([
            'name' => 'Administrator',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'is_admin' => true,
        ]);
        
        // Example 2: Using a Model Factory
        // User::factory(10)->create();
        
        // Example 3: Calling other Seeders
        // $this->call(PostsTableSeeder::class);
    }
}
```
### Execution

#### Registering the Seeder

If you want the seeder to run by default with db:seed, you must call it from the main `database/seeders/DatabaseSeeder.php` file's `run()` method:
```php
// In DatabaseSeeder.php
public function run(): void
{
    $this->call([
        UserSeeder::class,
        // ... other seeders
    ]);
}
```
#### Running the Seeders

* To run all registered seeders:` php artisan db:seed`
* To run a specific seeder: `php artisan db:seed --class=UserSeeder`

## Related Commands

* **db:seed** - The command used to execute the seeder classes.
* **make:factory** - Used to create the factories that seeders typically leverage for dummy data generation.
* **migrate:fresh --seed** - A common command used in development to drop the database, run all migrations, and then run all seeders.


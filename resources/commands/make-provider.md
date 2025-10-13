# make:provider

**Category**: Code Generation & Service Container

**Related**: make:class, make:command, bootstrap/providers.php

---

## Description

The `make:provider` command creates a new **Service Provider Class** in your `app/Providers` directory. Service Providers are the **central bootstrapping location** for all Laravel applications. They are responsible for binding services into the Service Container, registering events, defining middleware groups, and performing other setup tasks before the application handles a request.

In Laravel 12+, Service Providers are registered within the dedicated `bootstrap/providers.php` manifest file for faster application booting.

---

## When to Use This Command

- When you need to **register a custom class or interface implementation** into the Service Container (`$this->app->bind()`).
- When grouping a set of **route files, migrations, views, or configurations** for a custom module or package.
- When you need a central, early execution point for logic that must run on every request (in the `boot` method).
- To define **authorization gates and policies** (which often happens in `AuthServiceProvider`).

---

## Basic Usage

The command requires the name you wish to give your Service Provider Class.

`php artisan make:provider CustomServiceProvider`

---

## Available Options

| Option | Shortcut | Description |
| :--- | :--- | :--- |
| **--force** | | Create the class even if the provider already exists. |

---

## Practical Examples

Create a provider for custom domain services:
`php artisan make:provider DomainServiceProvider`

Create a provider for configuration related to third-party APIs:
`php artisan make:provider ApiConfigProvider`

---

## Generated Provider File

The command generates a file, for example `app/Providers/CustomServiceProvider.php`, with the following base structure:

```php
<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class CustomServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Logic for binding services to the container goes here (runs very early)
        // $this->app->bind(SomeInterface::class, SomeImplementation::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Logic for registering views, routes, or running code after other providers
        // $this->loadRoutesFrom(__DIR__.'/../routes/custom.php');
    }
}
```
### Registration
After creation, the new Service Provider must be registered by adding its class name to the `bootstrap/providers.php` file:
```php
// bootstrap/providers.php

return [
    // ... other core providers
    App\Providers\CustomServiceProvider::class, // <-- ADDED HERE
];
```
## Related Commands

* **make:class** - Used to create the classes (services, repositories) that the provider registers.
* **make:command** - Console commands can be registered within a service provider's boot method.
* **optimize** - Clears the Service Container cache and provider manifest for production performance.

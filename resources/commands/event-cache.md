# event:cache

**Category**: Performance Optimization

**Related**: event:clear, EventServiceProvider, Deployment

---

## Description

The `event:cache` command is a Laravel Artisan command used to **compile a manifest of all your application's events and their corresponding listeners** into a single, optimized PHP file.

This process significantly **improves application performance** in production environments by allowing the framework to load the pre-compiled manifest directly, bypassing the slower process of discovering and registering listeners via PHP reflection on every request.

---

## Usage

This command should be run during your application's **deployment process** to ensure the production environment uses the optimized manifest.

### Command Structure

`php artisan event:cache`

### Manifest Location

The optimized event/listener mapping is saved as a file (typically `events.php`) in the `bootstrap/cache` directory.

### Key Behavior

1. **Clears Existing Cache**: Running `event:cache` will automatically clear any existing event cache before rebuilding the new manifest.
2. **Required on Change**: If you add, remove, or modify events or listeners in your application, you must run this command again to update the cached mapping.

## Related Commands
|Command	|Purpose|
| :--- | :--- |
|`php artisan event:clear`	|Destroys the event cache file, forcing the framework to rediscover listeners via reflection on the next request.|
|`php artisan optimize`	|Runs a series of optimization commands, typically including `config:cache` and `route:cache`, but does not include `event:cache` by default (it must be run separately).|


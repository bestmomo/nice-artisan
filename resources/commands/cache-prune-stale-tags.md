# cache:prune-stale-tags

**Category**: Caching & Utilities

**Related**: cache:clear, Cache Tags, queue:work

---

## Description

The `cache:prune-stale-tags` command is a specialized utility used to **clean up lingering metadata associated with cache tags**. This command is crucial for maintaining the efficiency and memory footprint of cache stores that support tagging, such as **Redis** and **Memcached**.

When a tagged cache item is manually expired or flushed using `Cache::tags([...])->flush()`, the actual tagged item is removed, but a small amount of related metadata (a "stale tag") might remain in the cache store. This command specifically targets and removes that stale metadata, preventing unnecessary memory consumption.

---

## When to Use This Command

- **Mandatory for Tagged Caching:** If you utilize **cache tags** in your application, you should schedule this command to run regularly (e.g., hourly via your application's scheduler) to prevent memory leaks and bloating of your cache backend.
- **Supported Drivers Only:** It only works with cache drivers that support tagging, primarily **Redis** and **Memcached**. It is not effective, nor needed, for drivers like `file`, `database`, or `array`.

---

## Basic Usage

The command executes immediately and prunes stale tags from the **default cache store**.

`php artisan cache:prune-stale-tags`

---

## Available Options

| Option | Shortcut | Description |
| :--- | :--- | :--- |
| **store** | | Specify a particular cache store to prune tags from (e.g., `redis`). |

---

## Practical Examples

Prune stale tags from the store defined as `cache` in `config/cache.php`:
`php artisan cache:prune-stale-tags`

Prune stale tags only from a specific Redis cache connection named `redis-app`:
`php artisan cache:prune-stale-tags redis-app`

### Scheduling the Pruning

For production applications using cache tags, you must schedule this command in your `app/Console/Kernel.php` file:

```php
// In app/Console/Kernel.php -> schedule(Schedule $schedule)
protected function schedule(Schedule $schedule): void
{
    $schedule->command('cache:prune-stale-tags')->hourly();
}
```
## Related Concepts

* Cache Tags: Laravel allows you to tag related items in the cache so you can flush a group of entries using a single command (e.g., `Cache::tags(['posts', 'user:1'])->flush()`).
* Pruning Necessity: When a tag is flushed, the **tag index keys** are removed. However, the `cache:prune-stale-tags` command cleans up associated **set keys** that might otherwise be left behind, ensuring the cache store remains tidy.

# cache:clear 

**Category**: Caching & Utilities

**Related**: cache:forget, cache:table, config:cache, route:cache, view:clear

---

## Description

The `cache:clear` command flushes the entire contents of the application's **cache store**. This operation removes all items stored using Laravel's Caching system (typically items stored via the `Cache` facade or the `cache()` helper).

This command is essential for ensuring that your application is reading fresh data, especially after deploying code changes or debugging issues related to stale information being served from the cache.

---

## When to Use This Command

- When debugging an application that appears to be serving old data (stale data).
- After deploying code that relies on cached configuration or data to force the application to rebuild the cache with new values.
- To reset application-level caches *before* running performance benchmarks.

---

## Basic Usage

The command executes immediately and attempts to clear the default cache store.

`php artisan cache:clear`

---

## Available Options

| Option | Shortcut | Description |
| :--- | :--- | :--- |
| **--store** | | Specify a particular cache store to clear (e.g., `redis`, `memcached`, `file`). |

---

## Practical Examples

Clear the default cache store (as defined in `config/cache.php`):
`php artisan cache:clear`

Clear a specific cache store named `redis`:
`php artisan cache:clear --store=redis`

---

## Notes on Cache Scope

It is **crucial** to understand that `cache:clear` **only** targets the application's data cache (the cache used by the `Cache` facade).

It **does not** automatically clear the following crucial application caches, which require separate commands:

1.  **Configuration Cache:** Cleared using `config:clear`.
2.  **Route Cache:** Cleared using `route:clear`.
3.  **View Cache (Compiled Views):** Cleared using `view:clear`.
4.  **Application Bootstrapping/Container Cache:** Cleared using `optimize:clear`.

---

## Related Commands

- **cache:forget** - Removes only a specific key from the cache store.
- **config:clear** - Clears the cached configuration file.
- **route:clear** - Clears the compiled route definitions.
- **view:clear** - Clears the compiled Blade view files.

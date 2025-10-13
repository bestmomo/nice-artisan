# cache:forget

**Category**: Caching & Utilities

**Related**: cache:clear, cache:get, cache:put

---

## Description

The `cache:forget` command removes a **specific item** from the application's cache store using its unique key. Unlike `cache:clear`, which flushes the entire store, `cache:forget` allows for precise control over which cached data is invalidated.

This is extremely useful when you know a single piece of data is stale or invalid and needs to be refreshed on the next request without affecting other cached application data.

---

## When to Use This Command

- When debugging an issue related to **stale data** associated with a known cache key (e.g., `settings.homepage`).
- To manually invalidate a specific cache entry after a database record change (although automatic invalidation should ideally be handled by observers or event listeners).
- When a service or a background job fails, leaving an erroneous value in the cache.

---

## Basic Usage

The command requires the key of the cache entry you wish to remove.

`php artisan cache:forget my_long_running_report`

---

## Available Options

| Option | Shortcut | Description |
| :--- | :--- | :--- |
| **--store** | | Specify a particular cache store to forget the key from (e.g., `redis`, `memcached`). |

---

## Practical Examples

Remove a user-specific permission cache:
`php artisan cache:forget user:123:permissions`

Remove a cached route fragment from the `redis` store:
`php artisan cache:forget products:featured --store=redis`

---

## Notes

- **Success/Failure:** The command reports whether the item was successfully forgotten. If the key did not exist, the command still runs successfully and reports that the item was removed.
- **Data Integrity:** Use this command with caution in production environments, as removing a key that is frequently accessed might temporarily increase load on your database until the key is automatically rebuilt by the application logic.

---

## Related Commands

- **cache:clear** - Flushes all keys from the cache store.
- **cache:table** - Creates the migration needed if you are using the `database` cache driver.
- **cache:lock** - Related to the cache system's locking functionality.

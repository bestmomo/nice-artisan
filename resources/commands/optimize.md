# optimize (Obsolete)

**Category**: Performance / Caching

**Related**: config:cache, route:cache, view:cache

---

## Description

The `optimize` command was an Artisan utility used in older versions of Laravel (prior to Laravel 5.5) to boost application performance by **compiling many framework classes** into a single file.

This process significantly reduced the number of files PHP had to load on each request, speeding up the framework's boot process.

**⚠️ Current Status:** The `php artisan optimize` command is **obsolete** (deprecated) since Laravel 5.5. It is no longer effective or necessary due to improvements in PHP autoloading (PSR-4) and the use of **OpCache**, which handles bytecode caching much more efficiently. In modern versions, it may be an alias for other cache clear commands or perform no action at all.

---

## Usage

### Command Structure

`php artisan optimize`

### Options

| Option | Description |
| :--- | :--- |
| **--force** | Forces the regeneration of optimization files (now mainly route and config files). |
| **--stage** | Used in older versions to specify the caching environment (now deprecated). |

---

## Modern Replacement Commands (Laravel 6+)

To optimize a modern Laravel application for production, you should use these targeted commands instead:

* **Cache Configuration Files:**
  `php artisan config:cache`

* **Cache Route Definitions:**
  `php artisan route:cache`

* **Cache Blade Views:**
  `php artisan view:cache`

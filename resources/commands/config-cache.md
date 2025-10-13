# config:cache

**Category**: Caching & Performance

**Related**: config:clear, route:cache, optimize

---

## Description

The `config:cache` command compiles all of your application's configuration files into a **single, optimized PHP file** (typically stored at `bootstrap/cache/config.php`).

This command is critical for **production environments** because it drastically reduces the number of file system operations Laravel needs to perform during the bootstrapping process. Instead of loading dozens of individual configuration files, the application loads only one optimized file, significantly improving request handling speed.

---

## When to Use This Command

- **Deployment/Production:** This command should always be run as part of your application's **deployment script** (after pushing new code) to ensure optimal performance.
- **Never in Development:** You should **never** run this command during local development, as it prevents changes made in your `.env` file or `config/*.php` files from taking effect until the cache is cleared.

---

## Basic Usage

The command executes immediately, compiling the configuration.

`php artisan config:cache`

---

## Available Options

*Note: This command does not typically accept options.*

| Option | Shortcut | Description |
| :--- | :--- | :--- |
| **--force** | | Force the operation to run when in production. |

---

## Execution Caveats (The Important Part)

1.  **Environment Variables:** Once the configuration is cached, environment variables (`.env` values) are read and baked into the cache file **at the moment the command is run**.
    - You must only retrieve environment variables within your configuration files using the `env()` helper.
    - If you attempt to use the `env()` helper *outside* of your configuration files (e.g., in a controller or service), it will return `null` once the configuration is cached. Use the `config()` helper instead (e.g., `config('app.name')`).
2.  **Order of Operations:** If you change any configuration setting (in `config/*.php` files or the `.env` file), you **must** run `config:clear` and then `config:cache` again for the changes to take effect in production.

---

## Related Commands

- **config:clear** - The necessary command to remove the compiled configuration file, allowing the application to read individual files again.
- **route:cache** - The command to cache route definitions, often run alongside `config:cache` during deployment.
- **optimize** - A meta-command that runs several performance commands, including `config:cache` and `route:cache`.

# config:clear

**Category**: Caching & Performance

**Related**: config:cache, route:clear, optimize:clear

---

## Description

The `config:clear` command removes the compiled configuration file (`bootstrap/cache/config.php`) created by the `config:cache` command.

Clearing the configuration cache forces Laravel to reload its settings by reading and parsing **all** individual configuration files in the `config/` directory, as well as accessing the environment variables from the `.env` file during the bootstrapping process.

---

## When to Use This Command

- **Development:** This command is often run implicitly or manually during development to ensure that any recent changes to the `.env` file or files in `config/` are immediately recognized by the application.
- **Before Deployment:** If you ran `config:cache` in production and now need to change a setting, you **must** run `config:clear` before running `config:cache` again.
- **Debugging:** When facing issues where application behavior doesn't reflect your latest configuration changes.

---

## Basic Usage

The command executes immediately, deleting the cached configuration file.

`php artisan config:clear`

---

## Available Options

*Note: This command does not typically accept options.*

| Option | Shortcut | Description |
| :--- | :--- | :--- |
| **--force** | | Force the operation to run when in production. |

---

## Relationship with `config:cache`

These two commands are opposites and should be used exclusively:

| Environment | Command to Use | Purpose |
| :--- | :--- | :--- |
| **Local/Development** | **(Do nothing)** or `config:clear` | Ensures dynamic configuration loading. |
| **Production/Deployment** | `config:cache` | Optimizes performance by compiling the configuration. |

If the configuration is cached (`config:cache` was run), changes to the `.env` file **will be ignored** until `config:clear` is executed.

---

## Related Commands

- **config:cache** - The command used to create the compiled configuration file.
- **optimize:clear** - A meta-command that runs `config:clear`, `route:clear`, and `view:clear`.
- **route:clear** - Clears the compiled route definitions.

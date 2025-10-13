# auth:clear-resets

**Category**: Authentication / Cleanup

**Related**: forgot password implementation, password/reset view

---

## Description

The `auth:clear-resets` command is an Artisan utility in Laravel used to **delete all expired password reset tokens** from the database table (typically named `password_reset_tokens` or `password_resets`).

When a user initiates the "forgot password" process, a temporary, expiring token is generated and stored in the database. Over time, this table can accumulate many expired tokens. Running this command helps keep the table clean and removes tokens that are no longer valid, ensuring database efficiency and security.

This command is often executed as a scheduled task to run periodically (e.g., daily).

---

## Usage

### Command Structure

`php artisan auth:clear-resets`

### Options

| Option | Description |
| :--- | :--- |
| **--database** | Specifies the database connection to use for accessing the password reset table. |
| **--force** | Forces the command to run in a production environment without confirmation. |

---

## Practical Examples

1.  **Clear all expired password reset tokens:**
    `php artisan auth:clear-resets`

2.  **Set up token cleanup in the Scheduler (Kernel.php) to run daily:**
    `$schedule->command('auth:clear-resets')->daily();`

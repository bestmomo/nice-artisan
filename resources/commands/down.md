# down

**Category**: Application Management / Maintenance

**Related**: up, queue:work --force, env('APP_DOWN')

---

## Description

The `down` command is an essential Artisan utility in Laravel used to **put the application into maintenance mode** (or "down mode").

When an application is in maintenance mode, Laravel will display a standard `503 Service Unavailable` response to all users who navigate to the application. This is typically done before performing updates, deployments, or major maintenance tasks to prevent users from interacting with the application while it is in an inconsistent state.

When running this command, Laravel creates a file named **`storage/framework/down`** which acts as a flag for the maintenance mode state.

---

## Usage

### Command Structure

`php artisan down`

### Options

| Option | Description |
| :--- | :--- |
| **--message** | A custom message to display on the 503 error page. |
| **--retry** | The number of seconds the `Retry-After` HTTP header should be set to (useful for telling search engines/browsers when to check again). |
| **--secret** | A secret token that can be used to bypass maintenance mode (by accessing `/secret-token`), allowing developers to test the site. |
| **--render** | The name of the view to render instead of the default 503 page. |
| **--allow** | A comma-separated list of IP addresses that are still allowed to access the application while it is down. |

---

## Practical Examples

1.  **Put the application into maintenance mode:**
    `php artisan down`

2.  **Go down, allow developers at a specific IP to bypass the 503 page, and include a Retry-After header:**
    `php artisan down --allow=192.168.1.1 --retry=60`

3.  **Go down and define a secret bypass URL (e.g., access via /secret-key):**
    `php artisan down --secret="secret-key"`

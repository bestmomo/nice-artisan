# channel:list

**Category**: Broadcasting / Introspection

**Related**: route:list, broadcast:routes, config/broadcasting.php

---

## Description

The `channel:list` command is an Artisan utility in Laravel used to **display a formatted table of all broadcasting channels** registered in your application.

Broadcasting channels are typically defined in the `routes/channels.php` file and are used for real-time communication via WebSockets (e.g., using Laravel Echo and a broadcasting driver like Pusher, Redis, or WebSockets). This command lists all these channels, showing the channel name (URI), the authentication/authorization callback function, and the guards used.

It is the primary tool for debugging and verifying that your real-time channels are correctly registered and secured.

---

## Usage

### Command Structure

`php artisan channel:list`

### Output

The output is presented in a table, detailing the channel name, the callback/action, and any required authentication guards.

### Options

| Option | Description |
| :--- | :--- |
| **--name** | Filters the channels to only show those whose name matches the given pattern. |
| **--guarded** | Filters the channels to only show those that require authentication (i.e., those that have guards). |
| **--json** | Outputs the complete channel list as a raw JSON string. |

---

## Practical Examples

1.  **List all registered broadcasting channels:**
    `php artisan channel:list`

2.  **Filter channels to only show guarded (private or presence) channels:**
    `php artisan channel:list --guarded`

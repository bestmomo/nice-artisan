# install:broadcasting

**Category**: Broadcasting / Setup

**Related**: reverb:install, config/broadcasting.php, routes/channels.php

---

## Description

The `install:broadcasting` command is an Artisan utility in modern Laravel (L11+) used to **quickly set up the necessary files and configuration** for event broadcasting (real-time communication via WebSockets).

This command is interactive and typically prompts the user to select their desired broadcasting service, with **Laravel Reverb** being the preferred first-party option.

### Key Actions

The command performs several crucial setup steps:
1.  **File Creation:** Creates the `config/broadcasting.php` and `routes/channels.php` files (if they do not exist).
2.  **Dependencies:** Installs the necessary Composer and NPM packages (e.g., `laravel/reverb` and client-side libraries like Laravel Echo).
3.  **Configuration:** Updates the application's `.env` file with the appropriate connection variables (e.g., `BROADCAST_CONNECTION=reverb`).

If the user selects **Reverb**, this command runs the `php artisan reverb:install` command internally to finalize the configuration of the WebSocket server.

---

## Usage

### Command Structure

`php artisan install:broadcasting`

### Options

| Option | Description |
| :--- | :--- |
| **--reverb** | Automatically selects and installs **Laravel Reverb** as the broadcasting service, skipping the interactive prompt. |
| **--pusher** | Automatically selects and installs configuration for the **Pusher** service, skipping the interactive prompt. |
| **--ably** | Automatically selects and installs configuration for the **Ably** service, skipping the interactive prompt. |
| **--composer** | Specifies the absolute path to the Composer binary to use for package installation. |
| **--force** | Overwrite any existing broadcasting routes file without confirmation. |
| **--without-node** | Do not prompt or attempt to install Node dependencies (Laravel Echo, etc.). |

---

## Practical Examples

1.  **Install broadcasting interactively (will prompt for service):**
    `php artisan install:broadcasting`

2.  **Install broadcasting specifically for Laravel Reverb:**
    `php artisan install:broadcasting --reverb`

3.  **Install broadcasting for Pusher, skipping front-end dependencies:**
    `php artisan install:broadcasting --pusher --without-node`

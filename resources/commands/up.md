# up

**Category**: Application Management / Maintenance

**Related**: down, config/app.php

---

## Description

The `up` command is an essential Artisan utility in Laravel used to **bring the application out of maintenance mode** (or "down mode").

When executed, this command deletes the **`storage/framework/down`** file, which is the flag Laravel uses to determine if the application is in maintenance mode. Once this file is removed, the application immediately resumes normal operation, serving web requests, running scheduled tasks, and processing non-forced queue jobs.

This command should be the final step after a successful deployment, update, or maintenance window.

---

## Usage

### Command Structure

`php artisan up`

### Action

Deletes the `storage/framework/down` file, making the application fully accessible again.

### Options

This command is typically run without any options.

| Option | Description |
| :--- | :--- |
| **--help** | Displays the help screen for the command. |

---

## Practical Examples

1.  **Bring the application back online from maintenance mode:**
    `php artisan up`

2.  **Part of a post-deployment sequence:**
    #### ... deployment and migration commands
    `php artisan up`
    #### The application is now live

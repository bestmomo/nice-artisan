# storage:link

**Category**: Filesystem / Setup

**Related**: config/filesystems.php

---

## Description

The `storage:link` command is an essential Artisan utility in Laravel used to **create a symbolic link** (symlink) from your application's public directory to the internal `storage/app/public` directory.

Laravel's standard practice is to place files that should be publicly accessible (like user uploads, avatars, or media) into `storage/app/public`. Web servers, however, only serve files from the main `public/` directory. This command solves this by creating a symlink named `public/storage` that points to the internal `storage/app/public` directory, making those files accessible via a public URL (e.g., `https://your-app.com/storage/file.jpg`).

This command must be run once when setting up a new application or after deployment.

---

## Usage

### Command Structure

`php artisan storage:link`

### Symlink Details

| Source Directory | Target Link | Public URL Path |
| :--- | :--- | :--- |
| `storage/app/public` | `public/storage` | `storage/...` |

### Options

| Option | Description |
| :--- | :--- |
| **--relative** | Creates a **relative** symbolic link instead of an absolute one. This is often preferred for portability across different environments. |
| **--force** | Forces the creation of the symbolic link, even if a link already exists. |

---

## Practical Examples

1.  **Create the default absolute symbolic link:**
    `php artisan storage:link`

2.  **Create a relative symbolic link (recommended for most setups):**
    `php artisan storage:link --relative`

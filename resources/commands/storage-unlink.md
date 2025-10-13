# storage:unlink

**Category**: Filesystem / Setup

**Related**: storage:link, config/filesystems.php

---

## Description

The `storage:unlink` command is an Artisan utility in Laravel used to **delete the symbolic link** (symlink) previously created by the `php artisan storage:link` command.

This command removes the `public/storage` symlink that points to the internal `storage/app/public` directory. It does not delete any files within the `storage/app/public` directory; it only removes the public access point to those files.

This command is useful when you need to recreate the link, change the link's target, or when performing cleanup.

---

## Usage

### Command Structure

`php artisan storage:unlink`

### Actions

The command will look for the symbolic link at `public/storage` and attempt to remove it.

### Options

| Option | Description |
| :--- | :--- |
| **--help** | Displays the help screen for the command. |

---

## Practical Examples

1.  **Delete the existing `public/storage` symbolic link:**
    `php artisan storage:unlink`

2.  **Steps to recreate the symbolic link:**
    #### 1. Delete the old link
    `php artisan storage:unlink`

    #### 2. Create the new link (e.g., using a relative path)
    `php artisan storage:link --relative`

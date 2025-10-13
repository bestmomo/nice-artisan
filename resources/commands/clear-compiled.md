# clear-compiled (Obsolete)

**Category**: Performance / Cleanup

**Related**: optimize, optimize:clear, cache:clear

---

## Description

The `clear-compiled` command is an Artisan utility in Laravel used in **older versions** (prior to Laravel 5.5) to **delete the single compiled framework file**.

Before modern PHP optimization (OpCache) became standard, Laravel used the `php artisan optimize` command to merge most of its core files into one large file (`bootstrap/cache/compiled.php`). The `clear-compiled` command was used to safely remove this generated file.

**⚠️ Current Status:** This command is **obsolete** (deprecated) in modern versions of Laravel (5.5+). Since the framework no longer relies on compiling core files into one monolith, this command typically does nothing or is removed entirely. Modern application optimization relies on targeted caching commands like `config:cache` and `route:cache`.

---

## Usage

### Command Structure

`php artisan clear-compiled`

### Options

This command is typically run without any options.

| Option | Description |
| :--- | :--- |
| **--help** | Displays the help screen for the command. |

---

## Practical Examples

**Remove the compiled framework file (only relevant in older Laravel versions):**
`php artisan clear-compiled`

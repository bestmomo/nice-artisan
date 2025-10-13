# view:clear

**Category**: Performance / Views

**Related**: view:cache, config:clear, route:clear

---

## Description

The `view:clear` command is an Artisan utility in Laravel used to **delete all compiled Blade template files** from the application's view cache directory.

When you modify a Blade file, Laravel automatically recompiles the view. However, during development or when debugging, manually clearing the view cache ensures that the application is forced to re-read and re-compile *all* views from their source files on the next request. This helps to eliminate issues where old compiled versions might be incorrectly served after a code update.

The files deleted by this command are located in the `storage/framework/views` directory.

---

## Usage

### Command Structure

`php artisan view:clear`

### Options

This command is typically run without any options.

| Option | Description |
| :--- | :--- |
| **--help** | Displays the help screen for the command. |

---

## Practical Examples

**Clear the compiled Blade view cache:**
`php artisan view:clear`

# test

**Category**: Testing / Execution

**Related**: make:test, pest, phpunit.xml

---

## Description

The `test` command is the main Artisan utility in Laravel used to **execute your application's PHPUnit or Pest test suite**.

When run, this command loads the test environment (defined in `phpunit.xml`), executes the tests found in the `tests/` directory, and reports the results, including the number of assertions, tests run, failures, and coverage (if configured).

In modern Laravel (9+), this command provides rich, interactive output, including the ability to run tests from a watch mode, continuously monitoring file changes.

---

## Usage

### Command Structure

`php artisan test [options]`

### Options

| Option | Description |
| :--- | :--- |
| **--filter** | Filters tests to only run those whose names contain the given string. |
| **--testsuite** | Specifies a particular test suite to run (e.g., `Feature` or `Unit`). |
| **--coverage** | Generates code coverage reports (requires Xdebug or PCOV). |
| **--min** | Specifies the minimum required code coverage percentage to pass. |
| **--stop-on-failure** | Stops the test suite immediately after the first failure is encountered. |
| **--parallel** | Runs tests in parallel using multiple processes (requires the `brianium/paratest` package). |
| **--watch** | Automatically re-runs tests when relevant files in the project change (requires Node.js and `chokidar`). |
| **--pest** | Use the Pest runner (if installed) instead of PHPUnit. |

---

## Practical Examples

1.  **Run all unit and feature tests:**
    `php artisan test`

2.  **Run only the tests defined in the 'Feature' suite:**
    `php artisan test --testsuite=Feature`

3.  **Run tests continuously and re-run on file changes (Watch Mode):**
    `php artisan test --watch`

4.  **Run tests in parallel across four processes:**
    `php artisan test --parallel --processes=4`

# route:list

**Category**: Routing / Introspection

**Related**: route:cache, route:clear, make:controller

---

## Description

The `route:list` command is an essential Artisan utility in Laravel used to **display a formatted table of all registered routes** in your application.

This command reads your route files (`routes/*.php`) and outputs a comprehensive list that includes the HTTP method, the URI (path), the route name (if specified), the action (controller method or closure), and any assigned middleware. It is the primary tool for debugging routing issues and quickly auditing your application's endpoints.

---

## Usage

### Command Structure

`php artisan route:list`

### Output

The output is presented in a table, often color-coded, detailing the route information.

### Options

| Option | Description |
| :--- | :--- |
| **--name** | Filters the routes to only show those whose route name matches the given pattern (e.g., `user.*`). |
| **--method** | Filters the routes to only show those that match the given HTTP method (e.g., `GET`, `POST`). |
| **--path** | Filters the routes to only show those whose URI path matches the given pattern (e.g., `api/*`). |
| **--except-vendor** | Excludes routes defined by third-party packages installed in your vendor directory. |
| **--only-vendor** | Only includes routes defined by third-party packages installed in your vendor directory. |
| **--json** | Outputs the complete route list as a raw JSON string (useful for scripting). |

---

## Practical Examples

1.  **List all routes in the application:**
    `php artisan route:list`

2.  **Filter routes to only show POST requests:**
    `php artisan route:list --method=POST`

3.  **Show routes related to API paths, excluding vendor routes:**
    `php artisan route:list --path=api/* --except-vendor`

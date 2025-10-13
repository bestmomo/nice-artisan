# make:controller

**Category**: Code Generation / Controllers

**Related**: make:model, route:list, make:resource

## Description
The `make:controller` command is a fundamental Artisan utility in Laravel used to **create a new controller class** in the `app/Http/Controllers` directory.

Controllers are responsible for handling incoming HTTP requests, processing application logic, and returning the appropriate response (e.g., a view, a redirect, or JSON data). This command significantly speeds up development by generating the initial class file with the correct namespace and structure.

It offers several powerful options to automatically pre-populate the controller with methods for common use cases, such as RESTful resource handling.

---

## When to Use This Command
- When you need to handle a new route or endpoint
- When separating business logic from routes
- When creating RESTful APIs

## Basic Usage
`php artisan make:controller UserController`

## Arguments

| Argument | Description |
| :--- | :--- |
| **name** | The name of the controller class to generate (e.g., `PostController`). |

## Options

| Option | Description |
| :--- | :--- |
| **--api** | Generates an API controller with only the resource methods that do not involve showing views (`index`, `store`, `show`, `update`, `destroy`). |
| **--resource** | Generates a controller with the full set of seven resource methods for handling a resource (`index`, `create`, `store`, `show`, `edit`, `update`, `destroy`). |
| **--model** | Generates a resource or API controller and automatically types the resource methods to accept a given Eloquent model using Route Model Binding (e.g., `--model=Post`). |
| **--invokable** | Generates a single-action controller with only one `__invoke()` method. Ideal for simple, dedicated actions. |
| **--parent** | Generates a nested resource controller that assumes a parent model for nested routes (e.g., `CommentController --parent=Post`). |
| **--type** | Specifies a custom stub type to use for generation (rarely used). |

---

## Practical Examples
Basic controller:
`php artisan make:controller UserController`

Resource controller:
`php artisan make:controller PostController --resource`

API resource controller:
`php artisan make:controller ProductController --api`

Single action controller:
`php artisan make:controller ContactController --invokable`

With model:
`php artisan make:controller UserController --model=User`

## Related Commands
- **make:model** - Create Eloquent models
- **route:list** - View all registered routes

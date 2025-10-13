# make:view

**Category**: Code Generation & Front-end

**Related**: make:controller, make:component, route:list

---

## Description

The `make:view` command creates a new **Blade View file** (`.blade.php` extension) in your `resources/views` directory. Views contain the HTML markup for your application and are responsible for displaying data to the user.

While this command is a simple convenience wrapper around creating a file, it ensures the correct file extension and standardizes the location for all your front-end templates.

---

## When to Use This Command

- When creating a new page template (e.g., a form, a dashboard, or a landing page).
- To adhere to Laravel's file naming and location conventions (all views must reside in `resources/views`).
- When defining partials (small, reusable pieces of a view) or layouts.

---

## Basic Usage

The command requires the name of the view. You can use dot notation (`.`) to create subdirectories within `resources/views`.

`php artisan make:view index`

---

## Available Options

| Option | Shortcut | Description |
| :--- | :--- | :--- |
| **--force** | | Create the view even if the file already exists. |

---

## Practical Examples

Create a simple root view:
`php artisan make:view welcome`

Create a view inside a subdirectory (e.g., `resources/views/posts/show.blade.php`):
`php artisan make:view posts.show`

Create a partial (e.g., `resources/views/components/alert.blade.php`):
`php artisan make:view components.alert`

---

## Generated View File

The command generates a file, for example `resources/views/posts/show.blade.php`. By default, it creates an empty file:

```php
{{-- resources/views/posts/show.blade.php --}}

@extends('layouts.app') 

@section('content')
    <h1>{{ $post->title }}</h1>
    <p>{{ $post->body }}</p>
@endsection
```
_(The content shown above is an example of what you might put in the file; the command itself typically generates an empty file or a minimal template.)_

### Usage

The view is rendered using the global helper `view()` or returned from a controller method:
```php
// In a Controller
use Illuminate\Http\Request;

public function show(Request $request, Post $post)
{
    // The dot notation used in the command corresponds to the directory path
    return view('posts.show', ['post' => $post]); 
}
```
## Related Commands

* **make:controller** - The controller responsible for loading and passing data to the view.
* **make:component** - Used to create more complex, class-backed components that are consumed within the view files.
* **route:list** - Displays the routes that direct traffic to the controllers which, in turn, load the views.

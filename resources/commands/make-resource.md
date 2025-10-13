# make:resource

**Category**: Code Generation & API

**Related**: make:model, make:controller, toArray, apiResource

---

## Description

The `make:resource` command creates a new **API Resource Class** in your `app/Http/Resources` directory. API Resources allow you to transform and format your Eloquent models and model collections into JSON structures suitable for your API consumers.

Resources are essential for defining exactly which attributes of a model are exposed to the outside world, controlling data relationships, and applying custom formatting (e.g., date formats, currency).

---

## When to Use This Command

- When building a **JSON API** and needing to control the exact structure of the response payload.
- To hide sensitive attributes (like passwords or internal timestamps) before sending the data.
- To easily load and format model **relationships** within the output.
- When generating **conditional attributes** based on user permissions or request parameters.

---

## Basic Usage

The command requires the name you wish to give your Resource Class, often suffixed with `Resource`.

`php artisan make:resource UserResource`

---

## Available Options

| Option | Shortcut | Description |
| :--- | :--- | :--- |
| **--collection** | **-c** | Create a **Resource Collection** class, typically used to wrap lists of resources. |
| **--force** | | Create the class even if the resource already exists. |

---

## Practical Examples

Create a standard resource for a model:
`php artisan make:resource PostResource`

Create a resource and its corresponding collection class simultaneously:
`php artisan make:resource ProductResource -c`

---

## Generated Resource File

The command generates a file, for example `app/Http/Resources/PostResource.php`, with the following base structure:

```php
<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'published_at' => $this->created_at->format('Y-m-d H:i:s'),
            // Conditional relationships:
            // 'author' => new UserResource($this->whenLoaded('author')),
            // 'is_draft' => (bool) $this->is_draft,
        ];
    }
}
```
### Usage

The resource is typically returned from a controller:
```php
// Returning a single model
public function show(Post $post)
{
    return new PostResource($post);
}

// Returning a collection of models
public function index()
{
    $posts = Post::all();
    return PostResource::collection($posts);
}
```
## Related Commands

* **make:controller** - The controller where the resource is instantiated and returned.
* **make:model** - The Eloquent model whose data is being transformed by the resource.
* **route:list** - Displays the API endpoints that return these JSON structures.

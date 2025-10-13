# make:component

**Category**: Code Generation & Frontend

**Related**: make:view, make:livewire, make:model

---

## Description

The `make:component` command creates a new **Blade Component Class** and its corresponding Blade view file. Blade components allow you to encapsulate reusable chunks of UI logic and structure (like buttons, alerts, or navigation items) into a single, maintainable class.

This pattern promotes code reusability and clean views by keeping complex logic out of your template files.

---

## When to Use This Command

- When creating reusable UI elements that have associated PHP logic (e.g., passing data, computing classes).
- For encapsulating complex view sections (like forms or cards) for clarity and reuse across multiple pages.
- When organizing your views using a modern, component-based architecture.

---

## Basic Usage

The command requires the name of the component, often prefixed by the directory structure relative to `app/View/Components`.

`php artisan make:component Alert`

---

## Available Options

| Option | Shortcut | Description |
| :--- |:---------| :--- |
| **--view** |          | Create an inline view component (the view HTML is defined directly in the class). |
| **--force** |          | Create the class even if the component already exists. |

---

## Practical Examples

Create a component named `Alert` (class: `App\View\Components\Alert`, view: `resources/views/components/alert.blade.php`):
`php artisan make:component Alert`

Create a component in a subdirectory (`forms/button.blade.php`):
`php artisan make:component Forms/Button`

Create an inline view component (no separate Blade file generated):
`php artisan make:component InlineAlert --inline`

---

## Generated Component Files

The command generates two files by default (using `Alert` as example):

### 1. Component Class (`app/View/Components/Alert.php`)

```php
<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class Alert extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('components.alert');
    }
}
```

### 2. Blade View File (`resources/views/components/alert.blade.php`)
```html
<div>
    {{ $slot }}
</div>
```
#### Usage

The component is rendered in your Blade views using its snake-cased name:
```
<x-alert title="New Message">
    Your account has been updated successfully!
</x-alert>
```
## Related Commands

* **make:view** - Creates a standard Blade view file.
* **make:livewire** - Generates a Livewire component (adds interactivity).
* **vendor:publish** - Used to publish component templates from packages.

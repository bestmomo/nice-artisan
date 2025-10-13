# model:show

**Category**: Database Management / Model Introspection

**Related**: tinker, route:list, make:model

---

## Description

The `model:show` command is an Artisan utility in Laravel used to **display comprehensive information about a specific Eloquent model** in your application.

This command provides a detailed, structured overview of the model without needing to open the file or use a separate tool like `tinker`. The output typically includes:

1.  **Model Information:** Namespace, connection, table name.
2.  **Attributes/Columns:** All database columns for the model's table.
3.  **Casts:** How attributes are type-cast (e.g., `datetime`, `json`).
4.  **Relationships:** A list of all defined Eloquent relationships (e.g., `hasMany`, `belongsTo`).
5.  **Traits:** Any traits used by the model (e.g., `SoftDeletes`, `HasFactory`).

This is a powerful tool for auditing and debugging your model layer.

---

## Usage

### Command Structure

`php artisan model:show <model>`

### Arguments

| Argument | Description |
| :--- | :--- |
| **model** | The fully qualified class name (FQN) of the Eloquent model to inspect (e.g., `App\Models\User`). |

### Options

| Option | Description |
| :--- | :--- |
| **--json** | Outputs the model information as a raw JSON string. |

---

## Practical Examples

1.  **Display all details for the default User model:**
    `php artisan model:show App\Models\User`

2.  **Display details for a Post model and output the result as JSON:**
    `php artisan model:show App\Models\Post --json`

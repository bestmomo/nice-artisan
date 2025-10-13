# event:list

**Category**: Debugging & Introspection

**Related**: EventServiceProvider, Event Discovery, make:event, make:listener

---

## Description

The `event:list` command is an Artisan utility used to **display a formatted list of all events** registered in your Laravel application and the **listeners** that are currently subscribed to each one.

It checks both the event-listener mappings defined in your `EventServiceProvider` and any events discovered automatically by the framework (Event Discovery). It is a vital tool for debugging your event-driven architecture.

---

## Usage

### Command Structure

`php artisan event:list`

### Output

The output is presented in a clear table format, showing the event class name and a list of all associated listener classes or closures below it.

### Available Options

|Option	|Description|
| :--- | :--- |
|**--event**	|Filters the output to show only the listeners for a specific event class name.|
|**--json**	|Outputs the complete list of events and listeners as a raw JSON string (useful for scripting).|

## Practical Examples

List all events and headphones:

`php artisan event:list`

Filter by a specific event:

`php artisan event:list --event="App\Events\UserRegistered"`

Get the list in JSON format:

`php artisan event:list --json`

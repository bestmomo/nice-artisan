# queue:monitor

**Category**: Queue Management / Monitoring

**Related**: queue:work, queue:restart, config/queue.php

---

## Description

The `queue:monitor` command is an Artisan utility in Laravel used to **check the current job count** of specified queues and optionally **send an alert** if the count exceeds a predefined threshold.

This command is typically set up to run every minute via Laravel's Task Scheduling (`app/Console/Kernel.php`). It utilizes the queue connection's driver (like Redis or Database) to determine the current backlog size. If the backlog exceeds a configured maximum, Laravel can dispatch a notification to alert the system administrator.

---

## Usage

Before using this command, you must define the queues you want to monitor and their size thresholds within your application's configuration.

### Command Structure

`php artisan queue:monitor <queue-name> [queue-name] ...`

### Arguments

| Argument | Description |
| :--- | :--- |
| **queue-name** | One or more names of the queues to monitor. These queues must be configured in your application's monitoring settings. |

### Configuration

Monitoring is configured in the **`config/queue.php`** file under the `monitor` key.

Example configuration:
```php
'monitor' => [
    'default' => 100, // Monitor the default queue and alert if size > 100
    'emails' => 50, // Monitor the emails queue and alert if size > 50
],

# make:notification

**Category**: Code Generation & Notifications

**Related**: make:mail, make:event, notifications:table

---

## Description

The `make:notification` command creates a new **Notification Class** in your `app/Notifications` directory. Notifications provide a unified, expressive way to send messages across multiple delivery channels, such as email, SMS (via Nexmo/Twilio), Slack, database, and broadcast.

This centralized approach simplifies cross-channel communication and allows your application to easily switch or add new ways to alert users.

---

## When to Use This Command

- When you need to alert a user (or entity) about something important via **multiple channels** (e.g., email and database).
- When defining a standardized message format for system events (e.g., `InvoicePaid`, `PasswordReset`).
- When leveraging Laravel's built-in database notification system to display alerts within the application's UI.

---

## Basic Usage

The command requires the name you wish to give your Notification Class.

`php artisan make:notification InvoicePaid`

---

## Available Options

| Option | Shortcut | Description |
| :--- | :--- | :--- |
| **--markdown** | **-m** | Create the notification with a Markdown view template for the email channel. |
| **--force** | | Create the class even if the notification already exists. |

---

## Practical Examples

Create a simple notification:
`php artisan make:notification NewCommentNotification`

Create a notification with a Markdown email template:
`php artisan make:notification ServerDownAlert --markdown`

---

## Generated Notification File

The command generates a file, for example `app/Notifications/InvoicePaid.php`, with the following base structure:

```php
<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

class InvoicePaid extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        // Public properties defined here are available in the via() and to*() methods.
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail']; // Example channels: 'mail', 'database', 'broadcast', 'slack'
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): \Illuminate\Notifications\Messages\MailMessage
    {
        return (new \Illuminate\Notifications\Messages\MailMessage)
                    ->line('Your invoice has been paid.')
                    ->action('View Invoice', url('/invoice'))
                    ->line('Thank you for using our application!');
    }
}
```
### Sending the Notification

Notifications are sent via the `notify()` method available on any model that uses the Notifiable trait (like the default `App\Models\User`):
```php
use App\Notifications\InvoicePaid;

$user->notify(new InvoicePaid($invoice));
```
## Related Commands

* **make:mail** - Used when communication is strictly email-based and doesn't require other channels.
* **notifications:table** - Creates the migration required to use the database channel for persistent notifications.
* **queue:work** - Required to process notifications that are queued for sending.


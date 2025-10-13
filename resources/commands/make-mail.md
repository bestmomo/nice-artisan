# make:mail

**Category**: Code Generation & Email

**Related**: make:notification, queue:work, mail:send, mail:fake

---

## Description

The `make:mail` command creates a new **Mailable Class** in your `app/Mail` directory. Mailable classes encapsulate all the logic necessary to construct and send an email, including the view template, data population, attachments, and configuration (sender, subject, recipients).

Using Mailable classes is the standard, clean, and organized way to manage email communication in a Laravel application.

---

## When to Use This Command

- When defining a new type of transactional or communication email (e.g., `WelcomeEmail`, `InvoiceEmail`, `PasswordResetNotification`).
- When the email content requires dynamic data that must be passed from the application logic.
- When an email needs specific headers, attachments, or should be sent via a particular queue.

---

## Basic Usage

The command requires the name you wish to give your Mailable Class.

`php artisan make:mail WelcomeEmail`

---

## Available Options

| Option | Shortcut | Description |
| :--- | :--- | :--- |
| **--markdown** | **-m** | Create the Mailable with a Markdown view template. |
| **--force** | | Create the class even if the mailable already exists. |

---

## Practical Examples

Create a Mailable with a standard Blade view:
`php artisan make:mail OrderShippedMail`

Create a Mailable that uses a Markdown view (recommended for simple formatting):
`php artisan make:mail DailyReportMail --markdown`

---

## Generated Mailable File

The command generates a file, for example `app/Mail/WelcomeEmail.php`, with the following base structure:

```php
<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WelcomeEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct()
    {
        // Public properties defined here are automatically available to the view.
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Welcome to our application!',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.welcome', // Path to the Blade view file
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
```
If the `--markdown` option is used, the file **resources/views/emails/welcome.blade.php** is generated.

### Sending the Mailable

The Mailable is sent using the Mail facade:
```php
use App\Mail\WelcomeEmail;

// Send immediately
Mail::to($user->email)->send(new WelcomeEmail($user));

// Send via the queue (recommended for production)
Mail::to($user->email)->queue(new WelcomeEmail($user));
```
## Related Commands

* **make:notification** - Used for multi-channel notifications (including email).
* **queue:work** - Required to process emails sent using the queue() method.
* **mail:send** - Sends a Mailable directly from the console for testing purposes.
* **mail:fake** - A testing utility to ensure Mailable classes are correctly dispatched in tests.

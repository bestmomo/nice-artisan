# install:api (Breeze)

**Category**: Authentication / Setup

**Related**: install, install:web, Laravel Breeze, Laravel Sanctum

---

## Description

The `install:api` command is provided by the **Laravel Breeze** package, which must be installed first (`composer require laravel/breeze --dev`). Its purpose is to **scaffold the necessary files and configuration for an API-only application** using **Laravel Sanctum** for authentication.

This command sets up the following:

1.  **Sanctum Configuration:** Ensures Laravel Sanctum is properly configured for API token authentication.
2.  **API Routes:** Adds basic API routes and logic for registration, login, and token issuance.
3.  **Controllers:** Creates API-focused controllers (e.g., `RegisteredUserController`, `AuthenticatedSessionController`).
4.  **Testing:** Creates feature tests to verify the authentication endpoints.

It does **not** install any front-end scaffolding (like Blade views or JavaScript components).

---

## Usage

### Prerequisites

You must first install Laravel Breeze:
composer require laravel/breeze --dev

### Command Structure

`php artisan breeze:install api`

### Note

The command name is `breeze:install` with the argument `api`, not `install:api`.

### Options

| Option | Description |
| :--- | :--- |
| **--pest** | Use the Pest testing framework instead of PHPUnit when generating tests. |

---

## Practical Examples

1.  **Install the API authentication stack using PHPUnit:**
    `php artisan breeze:install api`

2.  **Install the API authentication stack using Pest:**
    `php artisan breeze:install api --pest`

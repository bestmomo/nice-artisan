# The env Command Group

**Category**: Configuration & Security

**Related**: config:cache, env(), --env option

---

## Description

The term `env` refers to a specialized group of Artisan commands primarily used for **managing the encryption and decryption of environment files** (like `.env`).

These commands are crucial for deployment, as they allow sensitive configuration data to be committed to a repository in an encrypted state, enhancing security.

---

## 1. env:encrypt (Encryption)

Encrypts a local `.env` file into a secure, encrypted file, typically named `.env.encrypted`.

| Command | Description |
| :--- | :--- |
| `php artisan env:encrypt` | Encrypts the current `.env` file. The decryption key is outputted and **must be stored securely**. |

**Options:**

| Option | Description |
| :--- | :--- |
| **--key** | Manually provide the encryption key. |
| **--env** | Specify a different environment file to encrypt (e.g., `php artisan env:encrypt --env=staging`). |

---

## 2. env:decrypt (Decryption)

Decrypts an encrypted `.env.encrypted` file back into a standard `.env` file.

| Command | Description |
| :--- | :--- |
| `php artisan env:decrypt` | Decrypts the file. It requires the key, usually retrieved from a secure server variable (`LARAVEL_ENV_ENCRYPTION_KEY`). |

**Options:**

| Option | Description |
| :--- | :--- |
| **--key** | Pass the decryption key directly to the command. |
| **--force** | Overwrite the existing, unencrypted `.env` file without prompting. |

---

## Related Environment Concepts

### A. The `--env` Option

Most core Artisan commands accept the `--env` option to load a specific environment configuration file instead of the default `.env`.

| Usage | Purpose |
| :--- | :--- |
| `php artisan test --env=testing` | Runs tests, loading configuration from **`.env.testing`**. |
| `php artisan tinker --env=staging` | Uses configuration settings from **`.env.staging`**. |

### B. The `env()` Helper Function

This helper is used *inside* your `config/*.php` files to pull values from the `.env` file.

```php
// Example in config/app.php
'name' => env('APP_NAME', 'Laravel'),

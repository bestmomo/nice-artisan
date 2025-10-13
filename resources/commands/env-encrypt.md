# env:encrypt

**Category**: Configuration & Security

**Related**: env:decrypt, .gitignore, Version Control

---

## Description

The `env:encrypt` command is an Artisan utility in Laravel (v9.32+) used to **encrypt the contents of an environment file** and save the result to a new file suffixed with `.encrypted`.

The primary goal of this command is to allow the encrypted environment file (which contains sensitive data like passwords and keys) to be safely committed to source control (like Git), while the plain text environment file (`.env`) is kept out of the repository using `.gitignore`.

---

## Usage

The command reads the target environment file, encrypts its contents using the AES-256-CBC cipher (by default), and writes the output to a new file.

### Command Structure

`php artisan env:encrypt`

### Key Management

When the command runs, it will:

1. **Generate a new, unique encryption key** (if not provided via `--key`).
2. **Display this key** in the console output.
3. **Crucially, this key must be stored securely** (e.g., in a password manager or cloud secret manager) as it will be required later by the `env:decrypt` command on the server to make the application operational.

## Available Options

|Option	|Description|
| :--- | :--- |
|**--key**	|Manually provide your own encryption key. Ensure the key length matches the requirements of the cipher (32 characters for AES-256-CBC).|
|**--env**	|Specify which environment file to encrypt (e.g., `php artisan env:encrypt` `--env=staging` will encrypt `.env.staging` and create `.env.staging.encrypted`).|
|**--force**	|Overwrite an existing encrypted file without prompting for confirmation.|
|**--cipher**	|Specify a different encryption cipher (e.g., `AES-256-CBC`).|
|**--prune**  |Delete the original, unencrypted environment file after successful encryption.|

## Practical Examples
**Encrypt the default `.env` file:**

`php artisan env:encrypt`

_(This creates `.env.encrypted` and outputs the new key.)_

**Encrypt a production environment file and delete the original:**

`php artisan env:encrypt --env=production --prune`

_(This encrypts `.env.production` to `.env.production.encrypted` and removes the original plain text file.)_

**Encrypt using a custom, known key (for team sharing):**

`php artisan env:encrypt --key=base64:3UVsEgGVK36XN82KKeyLFMhvosbZN1aF`

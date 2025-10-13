# env:decrypt

**Category**: Configuration & Security

**Related**: env:encrypt, config:cache, Deployment

---

## Description

The `env:decrypt` command is an Artisan utility used to **decrypt an encrypted environment file** (e.g., `.env.encrypted`) and write the plain text contents back to its standard `.env` file location.

This command is typically used during deployment to securely load sensitive configuration data onto a production server from a file that was committed to version control in an encrypted state.

---

## Usage

The command targets the encrypted file corresponding to the environment:

1.  It looks for the file named **`.env.encrypted`** by default.
2.  If the `--env` option is used, it looks for **`.env.{environment}.encrypted`** (e.g., `.env.staging.encrypted`).

### Command Structure

`php artisan env:decrypt`

### Decryption Key Requirement

The decryption key must be provided for the command to work. It checks for the key in two ways, in order of preference:

1. **Environment Variable**: It first attempts to read the key from the server environment variable: `LARAVEL_ENV_ENCRYPTION_KEY`.
2. `--key` **Option**: If the environment variable is not set, the key must be passed directly via the `--key` option.

## Available Options

|Option	|Description|
| :--- | :--- |
|**--key**	|(Required if `LARAVEL_ENV_ENCRYPTION_KEY` is not set) The encryption key used to encrypt the file.|
|**--env**	|Decrypt a specific environment file (e.g., `staging` to decrypt `.env.staging.encrypted`).|
|**--force**	|Overwrite an existing, non-encrypted environment file (e.g., `.env`) without prompting for confirmation.|
|**--cipher**	|Specify the cipher that was used for encryption (defaults to `AES-256-CBC`).|

## Practical Examples

Decrypt the default file using a key passed directly:

`php artisan env:decrypt --key="base64:UR9bH745sqGV62phOAVuxC8/MNh7PzjuB4DbHDn7w2c=" --force`

Decrypt the file using a key stored in a server variable (Common Deployment Scenario):

`# (Key is assumed to be set in LARAVEL_ENV_ENCRYPTION_KEY)
php artisan env:decrypt --force`

Decrypt a specific environment file (`.env.production.encrypted`):

`php artisan env:decrypt --env=production --key="base64:..." --force`





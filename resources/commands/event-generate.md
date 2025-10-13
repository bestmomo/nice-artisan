# event:generate

**Category**: Code Generation / Scaffolding

**Status**: DEPRECATED (Removed in recent Laravel versions)

**Replacement**: `php artisan make:event` and `php artisan make:listener` (or using **Automatic Event Discovery**)

---

## History

The `event:generate` command was used to **automatically generate missing class files** for events and listeners declared in the `$listen` array of `App\Providers\EventServiceProvider`.

It would iterate through the list of events and listeners and use the `make:event` and `make:listener` generators to create the corresponding files in the `app/Events` and `app/Listeners` directories.

The command did not take any arguments and operated on the contents of the `EventServiceProvider`.

### Commande structure

`php artisan event:generate`

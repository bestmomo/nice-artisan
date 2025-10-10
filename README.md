## Nice Artisan ##

This package adds a web interface for Laravel.

### Features

Nice Artisan provides a smooth and secure way to manage your application's commands:

* **Command Catalog**: browse and execute all your Laravel Artisan commands and custom commands directly from the interface.
* **Dynamic Command Preview**: as you fill out arguments and options in the form, the full Artisan command is generated in real-time, ready to be copied to your clipboard. 
* **Favorites System**: mark frequently used commands as favorites for quick access.
* **Search Functionality**: Easily find any command using the built-in search feature.* 
* **Intuitive Forms**: automatically generates form fields for all required arguments and optional options (including checkboxes for flags). 
* **Security Focused**: mandatory middleware configuration is provided to protect the interface, especially in production environments.

### New in V2 ###

* Added a **real-time command** preview feature.
* Added **favorites** functionality.
* Added **commands search**.
* Cleaned and simplified options forms.


### Quick Installation ###

Add Nice Artisan to your **composer.json** file :
```
    composer require bestmomo/nice-artisan
```

It will now be accessible at the following URL:
```
    .../niceartisan
```

### Middleware (security) ###

If you want to use this package on a production application, **you must protect the urls with a middleware** for your security !

To add a middleware for the package publish the configuration:
```
php artisan vendor:publish --tag=niceartisan:config
```

You can now define your protection logic. Add a route middleware to your application, for example:

```
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;  

class NiceArtisanProtection
{
  /**
  * Handle an incoming request.
  *
  * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
  */
  public function handle(Request $request, Closure $next): Response
  {
    // EXAMPLE: Only allow access in 'local' environment
    if (app()->isProduction()) 
    {
      abort(403, 'Nice Artisan is not allowed in production.');
    }
    
    // OR: Check if the user is authenticated and is an admin
    // if (! auth()->check() || ! auth()->user()->isAdmin())
    // {
    //   abort(403);
    // }

    return $next($request);
  }
}
```

Add the middleware to the `bootstrap/app.php` file:

```
->withMiddleware(function (Middleware $middleware) {
  $middleware->alias([
    'niceartisan' => \App\Http\Middleware\NiceArtisan::class,
  ]);
})
```

### Screenshots ###

![img1](screenshots/img1.png)

## Nice Artisan ##

This package adds a web interface for Laravel.

### New in V2 ###

- Added favorites
- Added commands search
- Cleaned options


### Quick Installation ###

Add Nice Artisan to your composer.json file :
```
    composer require bestmomo/nice-artisan
```

It will now be accessible at the following URL:
```
    .../niceartisan
```

### Middleware ###

If you want to use this package on a production application you must protect the urls with a middleware for your security !

To add a middleware for the package publish the configuration:
```
php artisan vendor:publish --tag=niceartisan:config
```

Add a route middleware to your application, for example :

```
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;  

class NiceArtisan
{
  /**
  * Handle an incoming request.
  *
  * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
  */
  public function handle(Request $request, Closure $next): Response
  {
    if (** your logical here **)
    {
      abort(403);
    }
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

![img1](screenshots/img1.jpg)
![img2](screenshots/img2.jpg)

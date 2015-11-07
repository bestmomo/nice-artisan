## Nice Artisan ##

This package is to add a web interface for Laravel 5 Artisan.

It's still a work in progress.

### Installation ###

Add Nice Artisan to your composer.json file :
```
    "require" : {
        ...
        "bestmomo/nice-artisan": "dev-master"
    }
```

Update Composer :
```
    composer update
```

The next required step is to add the service provider to config/app.php :
```
    Bestmomo\NiceArtisan\NiceArtisanServiceProvider::class,
```

Now it must work with this url :
```
    .../niceartisan
```

### Middleware ###

If you want to use this package on a production application you must protect the urls with a middleware for your security !

Add a route middleware to your application, for example :
```
<?php 

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;

class NiceArtisan {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = $request->user();

        if ($user && $user->isAdmin())
        {
            return $next($request);
        }
        return new RedirectResponse(url('/'));
    }

}
```

And register it in Kernel with `nice_artisan` name :

```
protected $routeMiddleware = [
    ....
    'nice_artisan' => \App\Http\Middleware\NiceArtisan::class,
];

``` 




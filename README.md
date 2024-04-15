## Nice Artisan ##

This package is to add a web interface for Laravel 5 and earlier Artisan.


### Installation ###

Add Nice Artisan to your composer.json file :

- For Laravel 5.1
```
    composer require bestmomo/nice-artisan:0.3.*
```
- For Laravel 5.2
```
    composer require bestmomo/nice-artisan:0.4.*
```
- For Laravel 5.3
```
    composer require bestmomo/nice-artisan:0.5.*
```
- For Laravel 5.4
```
    composer require bestmomo/nice-artisan:1.0.*
```
- For Laravel 5.5
```
    composer require bestmomo/nice-artisan:^1.1
```
- For Laravel ^6.0
```
    composer require bestmomo/nice-artisan:^1.2
```
- For Laravel ^7.0
```
    composer require bestmomo/nice-artisan:^1.3
```
- For Laravel ^8.0
```
    composer require bestmomo/nice-artisan:^1.4
```
- For Laravel ^9.0
```
    composer require bestmomo/nice-artisan:^1.6
```
- For Laravel ^10.0
```
    composer require bestmomo/nice-artisan:^1.7
```
- For Laravel ^11.0
```
    composer require bestmomo/nice-artisan:^1.8
```

For Laravel < 5.5 the next required step is to add the service provider to **config/app.php** (for Laravel 5.5 there is the package discovery) :
```
    Bestmomo\NiceArtisan\NiceArtisanServiceProvider::class,
```

Last copy the package config to your local config with the **publish** command:
```
    php artisan vendor:publish --tag=niceartisan:config
```

You can change options and commands in `config/commands.php`. The menu is dynamically created with this config.

Now it must work with this url (you can also change it in the config file):
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

class NiceArtisan
{
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

        if ($user && $user->isAdmin()) {
            return $next($request);
        }

        return redirect('/');
    }
}
```

And register it in Kernel with `nice_artisan` name :

```
'nice_artisan' => \App\Http\Middleware\NiceArtisan::class,
```

Before V1.6 this middleware will be automatically detected by package.

**From V1.6 you must specify the middleware in the **commands** configuration file :**

```
'middlewares' => [
    'web',
    'nice_artisan',
],
```

### Screenshots ###

![nice-artisan1](https://cloud.githubusercontent.com/assets/2959682/11610549/a9a3055c-9ba6-11e5-936b-f1d3830baf62.jpg)
![nice-artisan2](https://cloud.githubusercontent.com/assets/2959682/11610548/a9a308e0-9ba6-11e5-9cee-94d7cc373024.jpg)
![nice-artisan3](https://cloud.githubusercontent.com/assets/2959682/11610547/a9a00942-9ba6-11e5-88b6-9c30f25f220f.jpg)

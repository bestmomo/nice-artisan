<?php

namespace Bestmomo\NiceArtisan\Http;

use AppKernel;

class Kernel extends AppKernel
{

    /**
     * Determine if the kernel has a given route middleware.
     *
     * @param  string  $middleware
     * @return bool
     */
    public function hasRouteMiddleware($middleware)
    {
        return array_key_exists($middleware, $this->routeMiddleware);
    }

}
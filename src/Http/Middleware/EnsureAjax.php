<?php

namespace Bestmomo\NiceArtisan\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureAjax
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return Response
     */
    public function handle(Request $request, Closure $next, ?string $customMessage = null): Response
    {
        if (!$request->ajax()) {
            $message = $customMessage ?? 'This route is reserved for AJAX requests.';
            return response()->json(['error' => $message], Response::HTTP_FORBIDDEN);
        }

        return $next($request);
    }
}

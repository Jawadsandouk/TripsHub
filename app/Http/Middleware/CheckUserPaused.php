<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserPaused
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($user = $request->user()) {
            if ($user->is_paused && !$request->isMethod('GET') && !$request->routeIs('logout')) {
                abort(403, 'Your account is paused. You cannot perform this action.');
            }
        }

        return $next($request);
    }
}

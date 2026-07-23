<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        if ($request->user() && in_array($request->user()->role, $roles)) {
            return $next($request);
        }

        // Allow access if the user is impersonating (original user had the required role)
        if ($request->session()->has('impersonator')) {
            $originalUser = \App\Models\User::find($request->session()->get('impersonator'));
            if ($originalUser && in_array($originalUser->role, $roles)) {
                return $next($request);
            }
        }

        abort(403, 'Unauthorized access.');
    }
}

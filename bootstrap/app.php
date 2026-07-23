<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'role' => \App\Http\Middleware\CheckRole::class,
            'paused' => \App\Http\Middleware\CheckUserPaused::class,
        ]);

        $middleware->appendToGroup('web', \App\Http\Middleware\SetLocale::class);
        $middleware->appendToGroup('web', \App\Http\Middleware\CheckUserPaused::class);

        $middleware->validateCsrfTokens(except: [
            'logout',
        ]);

        $middleware->redirectUsersTo(function ($request) {
            $user = $request->user();
            if ($user) {
                return match ($user->role) {
                    'office' => '/office/dashboard',
                    'owner' => '/owner/dashboard',
                    'admin' => '/admin/offices',
                    default => '/user/dashboard',
                };
            }
            return '/user/dashboard';
        });
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
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
    ->withMiddleware(function (Middleware $middleware) {
        //
        
        // ✅ কাস্টম পারমিশন মিডলওয়্যার রেজিস্ট্রেশন
        $middleware->alias([
            'permission' => \App\Http\Middleware\CheckPermission::class,
            'role' => \App\Http\Middleware\CheckRole::class,
            'install.check' => \App\Http\Middleware\CheckForInstallation::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
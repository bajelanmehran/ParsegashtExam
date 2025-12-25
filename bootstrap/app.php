<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->remove(\Illuminate\Session\Middleware\StartSession::class);
        $middleware->remove(\Illuminate\View\Middleware\ShareErrorsFromSession::class);
        $middleware->remove(\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // تعیین اینکه چه زمانی exceptions به صورت JSON نمایش داده بشن
        $exceptions->shouldRenderJsonWhen(function (Request $request, Throwable $e) {
            return $request->is('api/*') || $request->expectsJson();
        });

        $exceptions->renderable(function (\Illuminate\Validation\ValidationException $e, Request $request) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        });

        $exceptions->renderable(function (\App\Exceptions\ApiException $e, Request $request) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        });

    })->create();

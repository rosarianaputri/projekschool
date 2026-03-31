<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )

    ->withMiddleware(function (Middleware $middleware): void {

        $middleware->alias([
            'role' => \App\Http\Middleware\CheckRole::class,
        ]);

    })

    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (\Throwable $e, Request $request) {
            if ($request->isMethod('post')) {
                $status = $e instanceof HttpExceptionInterface ? $e->getStatusCode() : null;

                if ($status === 419) {
                    return redirect()
                        ->route('login')
                        ->with('error', 'Sesi habis. Silakan coba login lagi.');
                }
            }

            return null;
        });
    })->create();
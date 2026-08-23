<?php

use App\Http\Middleware\CheckAdmin;
use App\Http\Middleware\CheckRole;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Exceptions\PostTooLargeException;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'check.admin' => CheckAdmin::class,
            'check.role' => CheckRole::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (PostTooLargeException $e, Request $request) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Ukuran data yang dikirim melebihi batas server.'], 413);
            }

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Gagal menyimpan: ukuran data yang dikirim melebihi batas server. Kecilkan foto (maksimal 2MB) lalu coba lagi.');
        });
    })->create();

<?php

use App\Http\Middleware\AddContext;
use App\Http\Middleware\AssignRequestId;
use App\Jobs\TestJob;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/status',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->trustHosts(at: fn () => config('app.trusted_hosts'));
        $middleware->append(AssignRequestId::class);
        $middleware->append(AddContext::class);
    })
    ->withSchedule(function (Schedule $schedule): void {
        $schedule->job(TestJob::class)->everyMinute();
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();

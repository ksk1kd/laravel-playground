<?php

namespace App\Http\Controllers;

use App\Http\Middleware\EnsureTokenIsValid;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class ProtectedController extends Controller implements HasMiddleware
{
    /**
     * Get the middleware that should be assigned to the controller.
     */
    public static function middleware(): array
    {
        return [
            EnsureTokenIsValid::class
        ];
    }

    /**
     * Show.
     */
    public function show(): string
    {
        return 'Protected Page From Controler';
    }
}

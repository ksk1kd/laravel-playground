<?php

use App\Http\Controllers\RateLimitingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/greeting', function (Request $request) {
    return 'Hello World';
});

Route::get('/rate-limit', [RateLimitingController::class, 'show']);

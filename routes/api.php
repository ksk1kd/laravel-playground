<?php

use App\Http\Controllers\RateLimitingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserModelController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/greeting', function (Request $request) {
    return 'Hello World';
});

Route::get('/rate-limit', [RateLimitingController::class, 'show']);

Route::get('/users/search', [UserController::class, 'search']);
Route::get('/users/count', [UserController::class, 'count']);
Route::apiResource('users', UserController::class);

Route::get('/model/users/search', [UserModelController::class, 'search']);
Route::get('/model/users/count', [UserModelController::class, 'count']);
Route::apiResource('model/users', UserModelController::class);

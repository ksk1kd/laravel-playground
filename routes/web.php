<?php

use App\Http\Controllers\GreetingController;
use App\Http\Controllers\ProtectedController;
use App\Http\Middleware\EnsureTokenIsValid;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/greeting', function () {
    return 'Hello World';
});
Route::get('/greeting/controler', [GreetingController::class, 'show']);

Route::redirect('/redirect', '/');

Route::get('/posts/{post}/comments/{comment}', function (string $postId, string $commentId) {
    return 'Post ID: ' . $postId . ', Comment ID: ' . $commentId;
})->whereNumber('post')->whereAlphaNumeric('comment');

Route::get('/protected', function () {
    return 'Protected Page';
})->middleware(EnsureTokenIsValid::class);
Route::get('/protected/controler', [ProtectedController::class, 'show']);

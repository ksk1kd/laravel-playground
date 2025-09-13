<?php

use App\Http\Controllers\GreetingController;
use App\Http\Controllers\ProtectedController;
use App\Http\Middleware\EnsureTokenIsValid;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/greeting', function () {
    return response('Hello World')->cookie(
        'name', 'value', 1000
    );
});
Route::get('/greeting/controler', [GreetingController::class, 'show']);

Route::redirect('/redirect', '/');

Route::get('/posts/{post}', function (string $postId) {
    return 'Sample Comment URL: ' . route('post.comment.show', ['post' => 11111, 'comment' => 'xxxxx']);
})
->whereNumber('post')
->name('post.show');
Route::get('/posts/{post}/comments/{comment}', function (string $postId, string $commentId) {
    return 'Post ID: ' . $postId . ', Comment ID: ' . $commentId;
})
->whereNumber('post')
->whereAlphaNumeric('comment')
->name('post.comment.show');

Route::get('/protected', function () {
    return 'Protected Page';
})->middleware(EnsureTokenIsValid::class);
Route::get('/protected/controler', [ProtectedController::class, 'show']);

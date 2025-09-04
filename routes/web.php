<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/greeting', function () {
    return 'Hello World';
});

Route::redirect('/redirect', '/');

Route::get('/posts/{post}/comments/{comment}', function (string $postId, string $commentId) {
    return 'Post ID: ' . $postId . ', Comment ID: ' . $commentId;
})->whereNumber('post')->whereAlphaNumeric('comment');

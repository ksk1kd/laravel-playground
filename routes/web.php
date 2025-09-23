<?php

use App\Http\Controllers\ArrController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\GreetingController;
use App\Http\Controllers\HttpClientController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProtectedController;
use App\Http\Middleware\EnsureTokenIsValid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
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
Route::get('/greeting/controler/{locale}', [GreetingController::class, 'show']);

Route::get('/collection', [CollectionController::class, 'show']);

Route::get('/arr', [ArrController::class, 'show']);

Route::get('/event', [EventController::class, 'show']);

Route::redirect('/redirect', '/');

Route::get('/posts/create', [PostController::class, 'create']);
Route::post('/posts', [PostController::class, 'store']);
Route::get('/posts', [PostController::class, 'index']);
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

Route::get('/session/put', function (Request $request) {
    $request->session()->put('sample_session', 'sample session value');
    return '';
});
Route::get('/session/get', function (Request $request) {
    $session_value = $request->session()->get('sample_session', 'default value');
    return 'Session Value: ' . $session_value;
});
Route::get('/session/forget', function (Request $request) {
    $request->session()->forget('sample_session');
    return '';
});

Route::get('/file-upload', [FileUploadController::class, 'index']);
Route::post('/file-upload', [FileUploadController::class, 'store']);

Route::get('/http-client', [HttpClientController::class, 'show']);

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/greeting', function (Request $request) {
    return 'Hello World';
});

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GreetingController extends Controller
{
    /**
     * Show the greeting.
     */
    public function show(): string
    {
        return 'Hello World From Controler';
    }
}

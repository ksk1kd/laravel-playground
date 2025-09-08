<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GreetingController extends Controller
{
    /**
     * Show the greeting.
     */
    public function show(Request $request): string
    {
        $response = "Hello World From Controler<br>";
        $response .= "Path: " . $request->path(); 
        return $response;
    }
}

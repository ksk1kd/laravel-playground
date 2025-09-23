<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HttpClientController extends Controller
{
    /**
     * Test Laravel HTTP Client functionality.
     */
    public function show(Request $request): string
    {
        // Basic GET request
        $response = Http::get('https://jsonplaceholder.typicode.com/posts/1');
        dump('Basic GET request', $response->json());
        dump('Status code', $response->status());

        return '';
    }

}
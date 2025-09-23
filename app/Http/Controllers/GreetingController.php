<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;

class GreetingController extends Controller
{
    /**
     * Show the greeting.
     */
    public function show(Request $request, string $locale = 'en'): string
    {
        if (! in_array($locale, ['en', 'ja'])) {
            abort(400);
        }

        App::setLocale($locale);

        $response = "Hello World From Controler<br>";
        $response .= "Path: " . $request->path() . "<br>";
        $names = $request->array('name');
        $response .= "Names: " . json_encode($names);
        // return $response;

        $time = Cache::remember('greeting time', 10, function () {
            return now();
        });

        return view('greeting', ['name' => 'Victoria', 'time' => $time]);
    }
}

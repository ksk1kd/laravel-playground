<?php

namespace App\Http\Controllers;

use App\Mail\Greeting;
use App\Notifications\Greeting as GreetingNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

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

        Mail::to('sample@example.com')->send(new Greeting());

        Notification::route('mail', 'sample@example.com')
            ->notify(new GreetingNotification());

        return view('greeting', ['name' => 'Victoria', 'time' => $time]);
    }
}

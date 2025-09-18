<?php

namespace App\Http\Controllers;

use App\Events\EventProcessed;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Show the event.
     */
    public function show(): string
    {
        EventProcessed::dispatch();
        return 'dispatched EventProcessed Event';
    }
}
